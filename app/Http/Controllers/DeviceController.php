<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceType;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        // Fetch all devices from the database
        $devices = Device::all();

        // Pass the devices to the view
        return view('devices.index', compact('devices'));
    }
    public function create()
    {
        $device_types = DeviceType::all();
        $studios = Studio::all();
        $users = User::all();

        return view('devices.create', compact('device_types', 'studios', 'users'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type_id' => 'required|exists:device_types,id',
            'studio_id' => 'required|exists:studios,id',
            'user_id' => 'nullable|exists:users,id',
            'year_of_manufacture' => 'required|integer',
            'purchase_date' => 'required|date',
            'max_loan_duration' => 'required|integer',
            'available' => 'boolean',
        ]);

        // Create the device using the validated data
        $device = Device::create($validated);

        // Redirect to the devices index or any other appropriate page
        return redirect()->route('devices.index')->with('success', 'Device created successfully!');
    }
}
