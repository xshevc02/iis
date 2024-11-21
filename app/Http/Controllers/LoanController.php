<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of loans.
     */
    public function index()
    {
        $loans = Loan::with('device', 'user')->get(); // Eager load related data

        return view('loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new loan.
     */
    public function create()
    {
        $devices = Device::where('available', true)->get();
        $users = User::all();

        return view('loans.create', compact('devices', 'users'));
    }

    /**
     * Store a newly created loan in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'device_id' => 'required|exists:devices,id',
            'issue_date' => 'required|date',
            'return_date' => 'nullable|date|after:issue_date',
            'time_from' => 'required',
            'time_to' => 'required|after:time_from',
            'status' => 'required|string|max:50',
        ]);

        Loan::create($validated);

        // Update device availability
        $device = Device::findOrFail($validated['device_id']);
        $device->update(['available' => false]);

        return redirect()->route('loans.index')->with('success', 'Loan created successfully!');
    }

    /**
     * Display the specified loan.
     */
    public function show($id)
    {
        $loan = Loan::with('device', 'user')->findOrFail($id);

        return view('loans.show', compact('loan'));
    }

    /**
     * Show the form for editing the specified loan.
     */
    public function edit($id)
    {
        $loan = Loan::findOrFail($id);
        $devices = Device::all();
        $users = User::all();

        return view('loans.edit', compact('loan', 'devices', 'users'));
    }

    /**
     * Update the specified loan in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'device_id' => 'required|exists:devices,id',
            'issue_date' => 'required|date',
            'return_date' => 'nullable|date|after:issue_date',
            'time_from' => 'required',
            'time_to' => 'required|after:time_from',
            'status' => 'required|string|max:50',
        ]);

        $loan = Loan::findOrFail($id);
        $loan->update($validated);

        // Update device availability if returned
        if ($validated['status'] === 'Returned') {
            $device = Device::findOrFail($validated['device_id']);
            $device->update(['available' => true]);
        }

        return redirect()->route('loans.index')->with('success', 'Loan updated successfully!');
    }

    /**
     * Remove the specified loan from storage.
     */
    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);

        // Set device availability back to true if loan is deleted
        $device = Device::findOrFail($loan->device_id);
        $device->update(['available' => true]);

        $loan->delete();

        return redirect()->route('loans.index')->with('success', 'Loan deleted successfully!');
    }
}
