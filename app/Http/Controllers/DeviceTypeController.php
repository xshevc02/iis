<?php

namespace App\Http\Controllers;

use App\Models\DeviceType;
use Illuminate\Http\Request;

class DeviceTypeController extends Controller
{
    // Display a listing of device types
    public function index()
    {
        $deviceTypes = DeviceType::paginate(10); // 10 items per page

        return view('device-types.index', compact('deviceTypes'));
    }

    // Show the form for creating a new device type
    public function create()
    {
        return view('device-types.create');
    }

    // Store a newly created device type in the database
    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'required|string|max:255',
        ]);

        DeviceType::create($request->all());

        return redirect()->route('device-types.index')->with('success', 'Device Type created successfully.');
    }

    // Display the specified device type
    public function show(DeviceType $deviceType)
    {
        return view('device-types.show', compact('deviceType'));
    }

    // Show the form for editing the specified device type
    public function edit(DeviceType $deviceType)
    {
        return view('device-types.edit', compact('deviceType'));
    }

    // Update the specified device type in the database
    public function update(Request $request, DeviceType $deviceType)
    {
        logger()->info('Update Device Type Request Data:', $request->all());

        // Validace příchozích dat
        $validated = $request->validate([
            'type_name' => 'required|string|max:255',
        ]);

        // Aktualizace typu zařízení
        $deviceType->update($validated);

        // Přesměrování zpět s úspěšnou hláškou
        return redirect()->route('device-types.index')->with('success', 'Device Type updated successfully!');
    }

    // Remove the specified device type from the database
    public function destroy(DeviceType $deviceType)
    {
        try {
            $deviceType->delete();

            return redirect()->route('device-types.index')->with('success', 'Device Type deleted successfully.');
        } catch (\Exception) {
            return redirect()->route('device-types.index')->with('error', 'Unable to delete Device Type. It may be linked to existing devices.');
        }
    }
}
