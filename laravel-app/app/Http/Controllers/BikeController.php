<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBikeRequest;
use App\Http\Requests\UpdateBikeRequest;
use App\Rules\TextUpper;
use Illuminate\Http\Request;
use App\Models\Bike;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BikeController extends Controller {
    private int $pagination;

    public function __construct() {
        $this->pagination = config('pagination.bikes', 15);
    }

    private function validateBike(Request $request, ?string $id = null, ?bool $confirmed = false) {
        return $request->validate([
            'brand' => ['required','string','max:255'],
            'model' => 'required|string|max:255',
            'color' => 'nullable|hex_color',
            'kms' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'registered' => 'required_with:bike_plate',
            'bike_plate' => ['required_if:registered,1',
                            'nullable',
                            'regex:/^\d{4}[B-Z]{3}$/i',
                            new TextUpper,
                            Rule::unique('bikes')->ignore($id ?? null),
                            $confirmed ? 'confirmed': ''],
            'image' => 'nullable|image|max:5120',
        ]);
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
        return view('bikes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBikeRequest $request) {
        $validated = $request->validated();
        if (empty($validated['buy_date'])) {
            unset($validated['buy_date']);
        }
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('image/bike', 'public');
        }

        $bike = Bike::create($validated);
        return redirect()->route('bikes.show', $bike)
            ->with('success', 'Bike created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $bike = Bike::findOrFail($id);
        return view('bikes.show', [
            'bike' => $bike
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        $bike = Bike::findOrFail($id);
        return view('bikes.edit', [
            'bike' => $bike
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBikeRequest $request, string $id) {
        $validated = $request->validated();
        $bike = Bike::findOrFail($id);
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
    public function destroy(string $id) {
        $bike = Bike::findOrFail($id);
        try {
            $bike->delete();
            if ($bike->image) {
                Storage::disk('public')->delete($bike->image);
            }
        } catch (\Exception $e) {
            logger("Error while removing bike: {$bike->id}");
        }
        return redirect()->route('bikes.index')
            ->with('success', 'Bike deleted successfully');
    }

    public function destroyImage(Bike $bike) {
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
    public function delete(string $id) {
        $bike = Bike::findOrFail($id);
        return view('bikes.delete', [
            'bike' => $bike
        ]);
    }
}
