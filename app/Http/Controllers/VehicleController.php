<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // ✅ correct


class VehicleController extends Controller
{
    //Display a listing of the vehicles.
    public function index()
    {
        $vehicles = Vehicle::latest()->get();
        return view('vehicles.index', compact('vehicles'));
    }

    //show the form for creating a new vehicle.
    public function create()
    {
        return view('vehicles.create');
    }
    //store a newly created vehicle in storage.

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'plate_number' => 'required|string|max:100|unique:vehicles,plate_number',
            'daily_rent_price' => 'required|numeric|min:0',
            'status' => 'required|in:available,rented,maintenance',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $data = $request->all();

        //image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('vehicles', 'public');
        }

        Vehicle::create($data);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully.');
    }

    // show the form for editing the specified vehicle.
    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    //update the specified vehicle in storage.
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'brand'            => 'required|string|max:255',
            'plate_number'     => 'required|string|max:50|unique:vehicles,plate_number,' . $vehicle->id,
            'daily_rent_price' => 'required|numeric|min:0',
            'status'           => 'required|in:available,rented,maintenance',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // Image update
        if ($request->hasFile('image')) {
            if ($vehicle->image) {
                Storage::disk('public')->delete($vehicle->image);
            }
            $data['image'] = $request->file('image')->store('vehicles', 'public');
        }

        $vehicle->update($data);

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Vehicle updated successfully.');
    }
    //remove the specified vehicle from storage.
    public function destroy(Vehicle $vehicle)
    {
        if ($vehicle->image) {
            Storage::disk('public')->delete($vehicle->image);
        }

        $vehicle->delete();

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Vehicle deleted successfully.');
    }
}
