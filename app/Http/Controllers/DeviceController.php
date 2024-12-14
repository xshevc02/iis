<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceType;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type_id' => 'required|exists:device_types,id',
            'studio_id' => 'required|exists:studios,id',
            'user_id' => 'nullable|exists:users,id',
            'year_of_manufacture' => 'required|integer',
            'purchase_date' => 'required|date',
            'max_loan_duration' => 'required|integer',
            'available' => 'nullable|boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if a photo was uploaded
        if ($request->hasFile('photo')) {
            // Store the image and get the file path
            $photoPath = $request->file('photo')->store('device_photos', 'public');

            // Debugging: check the stored path
            logger()->info('Uploaded photo path: '.$photoPath);

            // Store the file path in the database
            $validated['photo'] = $photoPath;
        }

        $device = Device::create($validated);

        return redirect()->route('devices.index')->with('success', 'Device created successfully!');
    }

    public function index(Request $request)
    {
        $deviceType = $request->input('device_type');

        $devices = Device::when($deviceType, function ($query, $deviceType) {
            $query->where('type_id', $deviceType);
        })->get();

        $deviceTypes = \App\Models\DeviceType::all(); // Fetch all device types

        return view('devices.index', compact('devices', 'deviceTypes'));
    }

    public function edit(int $id)
    {
        $device = Device::findOrFail($id);
        // Načíst všechna studia
        $studios = Studio::all();

        // Načíst všechny typy zařízení
        $device_types = DeviceType::all();

        // Vrátit šablonu s daty
        return view('devices.edit', compact('device', 'device_types', 'studios'));
    }

    public function update(Request $request, Device $device)
    {
        // Logování pro ladění
        logger()->info('Update Device Request Data:', $request->all());

        // Validace
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type_id' => 'required|exists:device_types,id',
            'studio_id' => 'required|exists:studios,id',
            'available' => 'nullable|boolean',
        ]);

        // Pokud checkbox "available" není zaškrtnutý, nastavíme hodnotu na false
        $validated['available'] = $request->has('available');

        // Aktualizace zařízení
        $device->update($validated);

        // Přesměrování zpět s potvrzením
        return redirect()->route('devices.index')->with('success', 'Device updated successfully!');
    }

    public function create()
    {
        $device_types = DeviceType::all();
        $studios = Studio::all();
        $users = User::all();

        return view('devices.create', compact('device_types', 'studios', 'users'));
    }

    public function show($id)
    {
        // Fetch the device by its ID
        $device = Device::findOrFail($id);

        // Return a view to display the device details
        return view('devices.show', compact('device'));
    }

    public function assignToUser(Request $request, $id)
    {
        $device = Device::findOrFail($id);
        $user = auth()->user(); // Or fetch another user as needed

        // Assign the device to the user
        $user->device_id = $device->id;
        $user->save();

        return redirect()->back()->with('success', 'Device successfully assigned to the user.');
    }

    public function destroy($id)
    {
        try {
            // Find the device by ID
            $device = Device::findOrFail($id);

            // Delete the device
            $device->delete();

            // Redirect back with a success message
            return redirect()->route('devices.index')->with('success', 'Device deleted successfully.');
        } catch (\Exception) {
            // Redirect back with an error message in case of failure
            return redirect()->route('devices.index')->with('error', 'Failed to delete the device.');
        }
    }
}
