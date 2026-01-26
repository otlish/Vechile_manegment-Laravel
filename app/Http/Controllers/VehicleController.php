<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use illuminate\support\Facades\Storage;

class VehicleController extends Controller
{
    //Display a listing of the vehicles.
    public function index(){
        $vehicles = Vehicle::latest()->get();
        return view('vehicles.index', compact('vehicles'));
    }

    //show the form for creating a new vehicle.
    public function create(){
        return view('vehicles.create');
    }
    //store a newly created vehicle in storage.

    public function store(Request $request){
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
        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('vehicles', 'public');
        }

        Vehicle::create($data);
        
        return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully.');
    }
}
