<?php

namespace App\Http\Controllers\Guest;

use App\Models\Manage_Room;
use App\Models\Reservations;
use Illuminate\Http\Request;
use App\Models\GuestInformation;
use App\Http\Controllers\Controller;

class GuestInvoiceController extends Controller
{
    public function view_invoice() {
        $reservation = Reservations::where('guest_id', auth()->user()->id)->latest()->first();
        $guestRegistration = GuestInformation::where('guest_id', auth()->user()->id)->latest()->first();
        // $rooms = Rooms::where('guest_id', auth()->user()->id)->latest()->first();
        $rooms = Manage_Room::where('id', function ($query) {
            $query->select('room_id')
                  ->from('reservations')
                  ->where('guest_id', auth()->user()->id)
                  ->latest()
                  ->first();
        })->first();
        

        return view('userGuest.guest_invoice', [
            'reservation' => $reservation,
            'guestRegistration' => $guestRegistration,
            'rooms' => $rooms,
        ]);
    }

      
    public function __construct()
    {
                $this->middleware('auth');
    }
}
