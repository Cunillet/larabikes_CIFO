<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;
use Illuminate\Support\Facades\Storage;

class BikeController extends Controller {
    private int $pagination;

    public function __construct() {
        $this->pagination = config('pagination.bikes', 15);
    }

    private function validateBike(Request $request) {

        return $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'kms' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'registered' => 'sometimes',
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
    public function store(Request $request) {
        $validated = $this->validateBike($request);
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
    public function update(Request $request, string $id) {
        $validated = $this->validateBike($request);

        /**
         * Manual validate:
         * if ($request->has('kms') && $request->kms > 0) {
         *      return back()
         *          ->withInput($request->except('kms'))    // fills fields with old() helper
         *          ->withErrors(['error' => 'kms can not be a negative value']);s
         * }
         */

        $bike = Bike::findOrFail($id);
        // checkbox unchecked do not come in the request
        // add 'registered' in case checkbox is not checked
        $bike->update($validated + ['registered' => 0]);
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
        $bike->delete();
        return redirect()->route('bikes.index')
            ->with('success', 'Bike deleted successfully');
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
