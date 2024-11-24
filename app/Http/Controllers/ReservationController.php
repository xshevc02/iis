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
        $reservations = Reservation::with(['user', 'device'])->get(); // Eager load related models

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new reservation.
     */
    public function create()
    {
        $users = User::all();
        $devices = Device::where('available', true)->get(); // Only available devices

        return view('reservations.create', compact('users', 'devices'));
    }

    /**
     * Store a newly created reservation in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'device_id' => 'required|exists:devices,id',
            'reservation_date' => 'required|date',
            'duration' => 'required|integer|min:1',
            'status' => 'required|string|max:50',
        ]);

        Reservation::create($validated);
        // Check device availability
        $device = Device::find($validated['device_id']);
        if ($device->available_from && $device->available_to) {
            $reservationStartTime = $request->reservation_date.' '.$device->available_from;
            $reservationEndTime = $request->reservation_date.' '.$device->available_to;

            // Validate that the reservation fits within the available hours
            if (strtotime($reservationStartTime) < strtotime($reservationEndTime)) {
                // Create the reservation
                $reservation = Reservation::create($validated);

                // Automatically create a loan based on the reservation
                Loan::create([
                    'user_id' => $validated['user_id'],
                    'device_id' => $validated['device_id'],
                    'issue_date' => $reservation->reservation_date,
                    'return_date' => date('Y-m-d', strtotime('+'.$validated['duration'].' days', strtotime($reservation->reservation_date))),
                    'status' => 'Loaned', // You can define a default status
                    'time_from' => $device->available_from,
                    'time_to' => $device->available_to,
                    'room' => $device->room, // Assuming the `room` column exists in the `devices` table
                ]);

                return redirect()->route('reservations.index')->with('success', 'Reservation and Loan created successfully.');
            } else {
                return redirect()->back()->withErrors(['The reservation does not fit within the available hours.']);
            }
        }

        return redirect()->back()->withErrors(['The device is not available for the selected date and time.']);
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
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully.');
    }
}
