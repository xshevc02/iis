<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Loan;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of reservations.
     */
    public function index()
    {
        $user = auth()->user(); // Get the authenticated user

        // Fetch only the reservations of the authenticated user
        $reservations = Reservation::where('user_id', $user->id)->get();

        // Pass the reservations to the view
        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new reservation.
     */
    public function create(Request $request)
    {
        $users = User::all();
        $devices = Device::where('available', true)->get(); // Only available devices

        $selectedDevice = null;
        if ($request->has('device_id')) {
            $selectedDevice = Device::find($request->device_id); // Fetch selected device if provided
        }

        return view('reservations.create', compact('users', 'devices', 'selectedDevice'));
    }

    /**
     * Store a newly created reservation in the database.
     */
    public function store(Request $request)
    {
        $user = auth()->user(); // Get the logged-in user

        // Check if the user can make reservations
        if (! $user->can_make_reservations) {
            return redirect()->route('no-access');
        }
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'device_id' => 'required|exists:devices,id',
            'reservation_date' => 'required|date',
            'duration' => 'required|integer|min:1',
            'status' => 'required|string|max:50',
        ]);

        // Get the device to check its max_loan_duration
        $device = Device::findOrFail($validated['device_id']);

        // Check if the requested duration exceeds the max_loan_duration
        if ($validated['duration'] > $device->max_loan_duration) {
            return back()->withErrors([
                'duration' => "The duration cannot exceed the maximum loan duration of {$device->max_loan_duration} days for this device.",
            ])->withInput();
        }
        // Calculate the end date of the reservation
        $endDate = date('Y-m-d', strtotime('+'.$validated['duration'].' days', strtotime($validated['reservation_date'])));

        // Check for overlapping reservations
        $overlappingReservation = Reservation::where('device_id', $validated['device_id'])
            ->where(function ($query) use ($validated, $endDate) {
                $query->whereBetween('reservation_date', [$validated['reservation_date'], $endDate])
                    ->orWhereRaw('? BETWEEN reservation_date AND DATE_ADD(reservation_date, INTERVAL duration DAY)', [$validated['reservation_date']])
                    ->orWhereRaw('? BETWEEN reservation_date AND DATE_ADD(reservation_date, INTERVAL duration DAY)', [$endDate]);
            })
            ->exists();

        if ($overlappingReservation) {
            return redirect()->back()->withErrors(['The device is already reserved during the requested period.']);
        }

        // Create the reservation
        $reservation = Reservation::create($validated);

        // Automatically create a loan for the reservation
        Loan::create([
            'user_id' => $validated['user_id'],
            'device_id' => $validated['device_id'],
            'issue_date' => $validated['reservation_date'],
            'return_date' => $endDate,
            'time_from' => '',
            'time_to' => '',
            'status' => 'Pending',
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation and Loan created successfully.');
    }

    /**
     * Display the specified reservation.
     */
    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified reservation.
     */
    public function edit(Reservation $reservation)
    {
        $users = User::all();
        $devices = Device::all();

        return view('reservations.edit', compact('reservation', 'users', 'devices'));
    }

    /**
     * Update the specified reservation in the database.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'device_id' => 'required|exists:devices,id',
            'reservation_date' => 'required|date',
            'duration' => 'required|integer|min:1',
            'status' => 'required|string|max:50',
        ]);

        $reservation->update($validated);

        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
    }

    /**
     * Remove the specified reservation from the database.
     */
    public function destroy(Reservation $reservation)
    {
        // Update the device availability before deleting the reservation
        $reservation->device->update(['available' => true]);

        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully.');
    }
}
