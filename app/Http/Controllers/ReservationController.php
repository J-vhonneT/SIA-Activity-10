<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::orderBy('reservation_date', 'desc')->get();
        $slots = range(1, 12);

        return view('reservations.index', compact('reservations', 'slots'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'slot_number' => 'required|integer|min:1|max:12',
            'reservation_date' => 'required|date',
            'duration_hours' => 'required|integer|min:1|max:5',
        ]);

        // Additional check to prevent double booking the same slot on the same day
        $existingReservation = Reservation::where('slot_number', $request->slot_number)
            ->where('reservation_date', $request->reservation_date)
            ->first();

        if ($existingReservation) {
            return back()->withErrors(['slot_number' => 'This slot is already reserved for the selected date.'])->withInput();
        }

        Reservation::create([
            'slot_number' => $request->slot_number,
            'reservation_date' => $request->reservation_date,
            'duration_hours' => $request->duration_hours,
            'user_id' => auth()->id(), // Associate the reservation with the logged-in user
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation confirmed successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}