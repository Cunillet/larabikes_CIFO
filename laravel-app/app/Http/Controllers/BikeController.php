<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteBikeRequest;
use App\Http\Requests\StoreBikeRequest;
use App\Http\Requests\UpdateBikeRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\Bike;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class BikeController extends Controller {

    use AuthorizesRequests;
    private int $pagination;

    public function __construct() {
        $this->pagination = config('pagination.bikes', 15);
    }

    /**
     * Display a listing of the resource.
     */
    public function list() {
        $bikes = Bike::orderBy('id', 'DESC')->paginate($this->pagination);
        return view('bikes.list', [
            'bikes' => $bikes
        ]);
    }
    /**
     * Display a grid of the resource.
     */
    public function index() {
        $bikes = Bike::orderBy('id', 'DESC')->paginate($this->pagination);
        return view('bikes.index', [
            'bikes' => $bikes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        if (Gate::denies('create', Bike::class)) {
            abort(403, 'Please Login with a verified account to create Motos.');
        }
        return view('bikes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBikeRequest $request) {
        if (Gate::denies('create', Bike::class)) {
            abort(403, 'Please Login with a verified account to create Motos.');
        }
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        if (empty($validated['buy_date'])) {
            unset($validated['buy_date']);
        }
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('image/bike', 'public');
        } else {
            unset($validated['image']);
        }

        $bike = Bike::create($validated);
        return redirect()->route('bikes.show', $bike)
            ->with('success', 'Bike created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $bike = Bike::with('circuits')->findOrFail($id);
        $allCircuits = \App\Models\Circuit::orderBy('name')->get();
        return view('bikes.show', [
            'bike' => $bike,
            'allCircuits' => $allCircuits,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        $bike = Bike::findOrFail($id);
        if (Gate::denies('update', $bike)) {
            abort(403, 'You do not have enough privileges to do this operation.');
        }
        $allCircuits = \App\Models\Circuit::orderBy('name')->get();
        return view('bikes.edit', [
            'bike' => $bike,
            'allCircuits' => $allCircuits,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBikeRequest $request, string $id) {
        $validated = $request->validated();
        $bike = Bike::findOrFail($id);
        if (Gate::denies('update', $bike)) {
            abort(403, 'You do not have enough privileges to do this operation.');
        }

        $oldImg = null;
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('image/bike', 'public');
            $oldImg = $bike->image;
        } else {
            unset($validated['image']);
        }

        /**
         * Manual validate:
         * if ($request->has('kms') && $request->kms > 0) {
         *      return back()
         *          ->withInput($request->except('kms'))    // fills fields with old() helper
         *          ->withErrors(['error' => 'kms can not be a negative value']);s
         * }
         */

        // checkbox unchecked do not come in the request
        // add 'registered' in case checkbox is not checked
        try {
            $bike->update($validated + ['registered' => 0]);
            if (!empty($oldImg)) {
                Storage::disk('public')->delete($oldImg);
            }
        } catch (\Exception $e) {
            logger("Error updating bike: {$bike->id}");
            logger("Error: {$e}");
        }
        return back()
            ->with('success', 'Bike updated successfully')
            ->cookie('lastUpdateId', $bike->id, 0);
    }

    public function search(Request $request, ?string $brand = null, ?string $model = null) {
        $brand = $brand ?? $request->query('brand', '');
        $model = $model ?? $request->query('model', '');

        $query = Bike::query();
        if (!empty($brand)) {
            $query->where('brand', 'like', "%{$brand}%");
        }
        
        if (!empty($model)) {
            $query->where('model', 'like', "%{$model}%");
        }
        $bikes = $query->orderBy('created_at', 'asc')
            ->paginate($this->pagination)
            ->withQueryString(); // this is to help pagination
        return view('bikes.index', [
            'bikes' => $bikes
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteBikeRequest $request, string $id) {
        $bike = Bike::findOrFail($id);
        if (Gate::denies('delete', $bike)) {
            abort(403, 'You do not have enough privileges to do this operation.');
        }

        try {
            $bike->delete();
            // do not remove because of soft deletes
            // if ($bike->image) {
            //     Storage::disk('public')->delete($bike->image);
            // }
        } catch (\Exception $e) {
            logger("Error while removing bike: {$bike->id}");
        }
        return redirect()->route('bikes.index')
            ->with('success', 'Bike deleted successfully');
    }

    public function destroyImage(Bike $bike) {
        if (Gate::denies('update', $bike)) {
            abort(403, 'You do not have enough privileges to do this operation.');
        }
        $image = $bike->image;
        try {
            $bike->update(['image' => null]);
            if ($image) {
                Storage::disk('public')->delete($image);
            }
        } catch (\Exception $e) {
            logger("Error on bike img delete. ID: {$bike->id}");
        }
        return back()->with('success', 'Image removed successfully');
    }

    /**
     * Show confirmation page before destroy
     */
    public function delete(DeleteBikeRequest $request, string $id) {
        $bike = Bike::findOrFail($id);
        if (Gate::denies('delete', $bike)) {
            abort(403, 'You do not have enough privileges to do this operation.');
        }
        return view('bikes.delete', [
            'bike' => $bike
        ]);
    }

    public function purge(Request $request) {
        $bike = Bike::onlyTrashed()->findOrFail($request->id);

        if ($request->user()->cant('delete', $bike)) {
            throw new AuthorizationException('You do not have privileges enough in order to delete this bike');
        }
        try {
            if ($bike->forceDelete() && $bike->image) {
                Storage::disk('public')->delete($bike->image);
            }
        } catch (\Exception $e) {
            abort(512, 'Error processing bike destroy. Please try again later or contact your administrator.<br>'.$e);
        }
        return back()->with(
            'success',
            "Bike {$bike->brand} {$bike->model} has been destroyed successfully"
        );
    }

    public function restore(Request $request) {
        $bike = Bike::withTrashed()->findOrFail($request->id);

        if ($request->user()->cant('restore', $bike)) {
            throw new AuthorizationException('You do not have privileges enough in order to restore this bike');
        }
        $bike->restore();
        return back()->with(
            'success',
            "Bike {$bike->brand} {$bike->model} has been restored successfully"
        );
    }
}
