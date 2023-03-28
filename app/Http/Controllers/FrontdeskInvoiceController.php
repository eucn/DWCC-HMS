<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use App\Models\Manage_Room;
use App\Models\Reservations;
use Illuminate\Http\Request;
use App\Models\GuestInformation;

class FrontdeskInvoiceController extends Controller
{
    //
    public function FrontdeskViewInvoice() {
        $reservation = Reservations::where('frontdesk_id', auth()->user()->id)->latest()->first();
        $guestRegistration = GuestInformation::where('frontdesk_id', auth()->user()->id)->latest()->first();
        // $rooms = Rooms::where('guest_id', auth()->user()->id)->latest()->first();
        $rooms = Manage_Room::where('id', function ($query) {
            $query->select('room_id')
                  ->from('reservations')
                  ->where('frontdesk_id', auth()->user()->id)
                  ->latest()
                  ->first();
        })->first();
        

        return view('frontdesk.frontdesk_invoice', [
            'reservation' => $reservation,
            'guestRegistration' => $guestRegistration,
            'rooms' => $rooms,
        ]);
    }

    public function ViewInvoice(){
       $reservation = Reservations::where('frontdesk_id', auth()->user()->id)->latest()->first();
        $guestRegistration = GuestInformation::where('frontdesk_id', auth()->user()->id)->latest()->first();
        // $rooms = Rooms::where('guest_id', auth()->user()->id)->latest()->first();
        $rooms = Manage_Room::where('id', function ($query) {
            $query->select('room_id')
                  ->from('reservations')
                  ->where('frontdesk_id', auth()->user()->id)
                  ->latest()
                  ->first();
        })->first();
        
        // $book = GuestInformation::get();
  
        $data = [
            'title' => 'Welcome to LaravelTuts.com',
            'date' => date('m/d/Y'),
            'guestRegistration' => $guestRegistration,
            'reservation' => $reservation,
            'rooms' => $rooms
        ]; 
            
        return view('frontdesk.frontdesk_generate-invoice', $data);
    }

    public function GenerateInvoice(){
        $reservation = Reservations::where('frontdesk_id', auth()->user()->id)->latest()->first();
        $guestRegistration = GuestInformation::where('frontdesk_id', auth()->user()->id)->latest()->first();
        // $rooms = Rooms::where('guest_id', auth()->user()->id)->latest()->first();
        $rooms = Manage_Room::where('id', function ($query) {
            $query->select('room_id')
                  ->from('reservations')
                  ->where('frontdesk_id', auth()->user()->id)
                  ->latest()
                  ->first();
        })->first();

         $data = [
            
            'date' => date('m/d/Y'),
            'guestRegistration' => $guestRegistration,
            'reservation' => $reservation,
            'rooms' => $rooms
        ]; 

        $pdf = PDF::loadView('frontdesk.frontdesk_generate-invoice', $data);
     
        return $pdf->download('invoice.pdf');
    }

      
    public function __construct()
    {
                $this->middleware('auth');
    }
}
