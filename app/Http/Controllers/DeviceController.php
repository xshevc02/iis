<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceType;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
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

    /**
     * Show the form for editing the specified device.
     *
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        // Najít zařízení podle ID
        $device = Device::findOrFail($id);

        // Načíst všechna studia
        $studios = Studio::all();

        // Načíst všechny typy zařízení
        $device_types = DeviceType::all();

        // Vrátit šablonu s daty
        return view('devices.edit', compact('device', 'device_types', 'studios'));
    }


    /**
     * Update the specified device in the database.
     *
     * @return RedirectResponse
     */
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

    public function show($id)
    {
        // Fetch the device by its ID
        $device = Device::findOrFail($id);

        // Return a view to display the device details
        return view('devices.show', compact('device'));
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
