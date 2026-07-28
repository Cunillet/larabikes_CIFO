<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bike;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BikeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bikes = Bike::withTrashed()->paginate(15);
        
        return response()->json([
            'success' => true,
            'status' => 'success',
            'data' => $bikes,
            'message' => 'Bikes retrieved successfully'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $bike = new Bike();
        $bike->user_id = auth()->id();
        $bike->brand = $request->brand;
        $bike->model = $request->model;
        $bike->price = $request->price;
        $bike->description = $request->description;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('bikes', 'public');
            $bike->image = $path;
        }

        $bike->save();

        return response()->json([
            'success' => true,
            'status' => 'success',
            'data' => $bike,
            'message' => 'Bike created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $bike = Bike::withTrashed()->find($id);
        
        if (!$bike) {
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => 'Bike not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'status' => 'success',
            'data' => $bike,
            'message' => 'Bike retrieved successfully'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $bike = Bike::withTrashed()->find($id);

        if (!$bike) {
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => 'Bike not found'
            ], 404);
        }

        if (Gate::denies('update', $bike)) {
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => 'You are not authorized to update this bike'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'brand' => 'sometimes|string|max:255',
            'model' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        if ($request->has('brand')) $bike->brand = $request->brand;
        if ($request->has('model')) $bike->model = $request->model;
        if ($request->has('price')) $bike->price = $request->price;
        if ($request->has('description')) $bike->description = $request->description;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($bike->image) {
                Storage::disk('public')->delete($bike->image);
            }
            $path = $request->file('image')->store('bikes', 'public');
            $bike->image = $path;
        }

        $bike->save();

        return response()->json([
            'success' => true,
            'status' => 'success',
            'data' => $bike,
            'message' => 'Bike updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy($id): JsonResponse
    {
        $bike = Bike::find($id);

        if (!$bike) {
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => 'Bike not found or already deleted'
            ], 404);
        }

        if (Gate::denies('delete', $bike)) {
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => 'You are not authorized to delete this bike'
            ], 403);
        }

        $bike->delete();

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Bike deleted successfully'
        ], 200);
    }

    /**
     * Restore a soft-deleted bike.
     */
    public function restore($id): JsonResponse
    {
        $user = auth()->user();

        if (! $user || ! $user->hasRole('admin')) {
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => 'Only administrators can restore bikes'
            ], 403);
        }

        $bike = Bike::onlyTrashed()->find($id);
        
        if (!$bike) {
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => 'Bike not found in trash'
            ], 404);
        }

        $bike->restore();

        return response()->json([
            'success' => true,
            'status' => 'success',
            'data' => $bike,
            'message' => 'Bike restored successfully'
        ], 200);
    }

    /**
     * Permanently delete a bike.
     */
    public function forceDelete($id): JsonResponse
    {
        $user = auth()->user();

        if (! $user || ! $user->hasRole('admin')) {
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => 'Only administrators can permanently delete bikes'
            ], 403);
        }

        $bike = Bike::withTrashed()->find($id);
        
        if (!$bike) {
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => 'Bike not found'
            ], 404);
        }

        // Delete image if exists
        if ($bike->image) {
            Storage::disk('public')->delete($bike->image);
        }

        $bike->forceDelete();

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Bike permanently deleted successfully'
        ], 200);
    }

    /**
     * Search bikes by brand and/or model.
     */
    public function search(Request $request)
    {
        $query = Bike::query();

        if ($request->has('brand') && $request->brand) {
            $query->where('brand', 'LIKE', '%' . $request->brand . '%');
        }

        if ($request->has('model') && $request->model) {
            $query->where('model', 'LIKE', '%' . $request->model . '%');
        }

        $bikes = $query->paginate(15);

        return response()->json([
            'success' => true,
            'status' => 'success',
            'data' => $bikes,
            'message' => 'Search results retrieved successfully'
        ], 200);
    }
}
