<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreCircuitRequest;
use App\Http\Requests\UpdateCircuitRequest;
use App\Models\Circuit;
use App\Models\Country;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class CircuitController extends Controller
{
    use AuthorizesRequests;

    private int $pagination;

    public function __construct()
    {
        $this->pagination = config('pagination.circuits', 12);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $circuits = Circuit::orderBy('name', 'ASC')->paginate($this->pagination);
        return view('admin.circuits.index', [
            'circuits' => $circuits,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('create', Circuit::class)) {
            abort(403, 'Only admin users can create circuits.');
        }
        $countries = Country::all();
        return view('admin.circuits.create', [
            'countries' => $countries,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCircuitRequest $request)
    {
        if (Gate::denies('create', Circuit::class)) {
            abort(403, 'Only admin users can create circuits.');
        }

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('image/circuit', 'public');
        } else {
            unset($validated['image']);
        }

        $circuit = Circuit::create($validated);

        return redirect()->route('admin.circuits.show', $circuit)
            ->with('success', 'Circuit created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $circuit = Circuit::with('country')->findOrFail($id);
        return view('admin.circuits.show', [
            'circuit' => $circuit,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $circuit = Circuit::findOrFail($id);
        if (Gate::denies('update', $circuit)) {
            abort(403, 'Only admin users can edit circuits.');
        }
        $countries = Country::all();
        return view('admin.circuits.edit', [
            'circuit' => $circuit,
            'countries' => $countries,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCircuitRequest $request, string $id)
    {
        $validated = $request->validated();
        $circuit = Circuit::findOrFail($id);
        if (Gate::denies('update', $circuit)) {
            abort(403, 'Only admin users can edit circuits.');
        }

        $oldImg = null;
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('image/circuit', 'public');
            $oldImg = $circuit->image;
        } else {
            unset($validated['image']);
        }

        try {
            $circuit->update($validated);
            if (!empty($oldImg)) {
                Storage::disk('public')->delete($oldImg);
            }
        } catch (\Exception $e) {
            logger("Error updating circuit: {$circuit->id}");
            logger("Error: {$e}");
        }

        return back()
            ->with('success', 'Circuit updated successfully');
    }

    /**
     * Show confirmation page before destroy
     */
    public function delete(Request $request, string $id)
    {
        $circuit = Circuit::findOrFail($id);
        if (Gate::denies('delete', $circuit)) {
            abort(403, 'Only admin users can delete circuits.');
        }
        return view('admin.circuits.delete', [
            'circuit' => $circuit,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $circuit = Circuit::findOrFail($id);
        if (Gate::denies('delete', $circuit)) {
            abort(403, 'Only admin users can delete circuits.');
        }

        try {
            if ($circuit->image) {
                Storage::disk('public')->delete($circuit->image);
            }
            $circuit->delete();
        } catch (\Exception $e) {
            logger("Error while removing circuit: {$circuit->id}");
            abort(512, 'Error processing circuit deletion. Please try again later.');
        }

        return redirect()->route('admin.circuits.index')
            ->with('success', 'Circuit deleted successfully');
    }

    /**
     * Remove the image from the specified circuit.
     */
    public function destroyImage(Circuit $circuit)
    {
        if (Gate::denies('update', $circuit)) {
            abort(403, 'Only admin users can edit circuits.');
        }
        $image = $circuit->image;
        try {
            $circuit->update(['image' => null]);
            if ($image) {
                Storage::disk('public')->delete($image);
            }
        } catch (\Exception $e) {
            logger("Error on circuit img delete. ID: {$circuit->id}");
        }
        return back()->with('success', 'Image removed successfully');
    }
}
