<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreBikeCircuitRequest;
use App\Http\Requests\UpdateBikeCircuitRequest;
use App\Models\Bike;
use App\Models\Circuit;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BikeCircuitController extends Controller
{
    use AuthorizesRequests;

    /**
     * Attach a circuit time to a bike.
     */
    public function store(Bike $bike, StoreBikeCircuitRequest $request)
    {
        if (Gate::denies('update', $bike)) {
            abort(403, 'You do not have enough privileges to manage circuit times.');
        }

        $validated = $request->validated();

        try {
            $bike->circuits()->attach($validated['circuit_id'], [
                'lap_time' => $validated['lap_time'],
                'record_date' => $validated['record_date'] ?? null,
            ]);
        } catch (\Exception $e) {
            logger("Error adding circuit time to bike: {$bike->id}");
            return back()->withErrors(['error' => 'Error adding circuit time.']);
        }

        return back()->with('success', 'Circuit time added successfully');
    }

    /**
     * Update a circuit time for a bike.
     */
    public function update(Bike $bike, Circuit $circuit, UpdateBikeCircuitRequest $request)
    {
        if (Gate::denies('update', $bike)) {
            abort(403, 'You do not have enough privileges to manage circuit times.');
        }

        $validated = $request->validated();

        try {
            $bike->circuits()->updateExistingPivot($circuit->id, [
                'lap_time' => $validated['lap_time'],
                'record_date' => $validated['record_date'] ?? null,
            ]);
        } catch (\Exception $e) {
            logger("Error updating circuit time for bike: {$bike->id}, circuit: {$circuit->id}");
            return back()->withErrors(['error' => 'Error updating circuit time.']);
        }

        return back()->with('success', 'Circuit time updated successfully');
    }

    /**
     * Detach a circuit time from a bike.
     */
    public function destroy(Bike $bike, Circuit $circuit)
    {
        if (Gate::denies('update', $bike)) {
            throw new AuthorizationException('You do not have enough privileges to manage circuit times.');
        }

        try {
            $bike->circuits()->detach($circuit->id);
        } catch (\Exception $e) {
            logger("Error removing circuit time for bike: {$bike->id}, circuit: {$circuit->id}");
            return back()->withErrors(['error' => 'Error removing circuit time.']);
        }

        return back()->with('success', 'Circuit time removed successfully');
    }
}
