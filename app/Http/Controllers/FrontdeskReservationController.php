<?php

namespace App\Http\Controllers;
use App\Models\GuestInformation;
use App\Models\Manage_Room;
use App\Models\Reservations;
use App\Models\Walkin_Reservation;
use App\Models\Walkin_Reservations;
use Illuminate\Http\Request;

class FrontdeskReservationController extends Controller
{
    public function FrontdeskReservation(){
        $room_type = Manage_Room::distinct()->pluck('room_type');
        return view('frontdesk.frontdesk_reservation', compact('room_type'));
    }
    public function getRoomId(Request $request)
    {
        $roomType = $request->input('room_type');

        $room = Manage_Room::where('room_type', $roomType)->first();
    
        if ($room){
            $roomId = $room->id;
            return response()->json(['room_id' => $roomId]);
        } else {
            return response()->json(['error' => 'Room type not found']);
        }
    }
    
     public function FrontdeskReservationSave(Request $request)
    {
        $frontdesk_id = auth()->user()->id;

        // $room_type = $request->input('room_type');
        $room_id = $request->input('room_id');
        $checkin_date = $request->input('check_in_date');
        $checkout_date = $request->input('check_out_date');
    
    //     $reservations = Reservations::where('room_id', $room_id)
    //     ->where(function($query) use ($checkin_date, $checkout_date) {
    //         $query->whereBetween('checkin_date', [$checkin_date, $checkout_date])
    //             ->orWhereBetween('checkout_date', [$checkin_date, $checkout_date])
    //             ->orWhere(function($query) use ($checkin_date, $checkout_date) {
    //                 $query->where('checkin_date', '<', $checkin_date)
    //                         ->where('checkout_date', '>', $checkout_date);
    //             });
    //     })
    //     ->get();

    // if (!$reservations->isEmpty()) {
    //     // room is already reserved, return an error message or redirect back with an error message
    //     return redirect()->back()->with('error', 'The room is already reserved for the selected dates.');
    // }else{
            $room_id = $request->input('room_id');
            $checkin_date = $request->input('check_in_date');
            $checkout_date = $request->input('check_out_date');
            $extraBed =  $request->input('extra_bed');
            $numGuests = $request->input('guest_num');
            $numNights = $request->input('number_of_nights');
            $checkindateSave = date('Y-m-d', strtotime($checkin_date));
            $checkoutdateSave = date('Y-m-d', strtotime($checkin_date));

            $add_numGuests = 300;
            $roomPrice = Manage_Room::where('id', $room_id)->value('rate');
            if ($numNights > 1) {
                $total_roomPrice = $roomPrice * $numNights;
            } else {
                $total_roomPrice = $roomPrice;
            }
            if ($numGuests > 1) {
            $numGuestFee = $add_numGuests *  $numGuests;
            } else {
                $numGuestFee  = 0;
            }
            $total_numGuestFee =  $numGuestFee ;
            $totalPrice = $total_roomPrice +  $total_numGuestFee;

            $reservation = new Walkin_Reservations();
            $reservation->frontdesk = $frontdesk_id;
            $reservation->room_id = $room_id;
            $reservation->checkin_date = $checkindateSave;
            $reservation->checkout_date = $checkoutdateSave;
            $reservation->nights = $numNights;
            $reservation->booking_status = 'Pending';
            $reservation->base_price = $roomPrice;
            $reservation->total_price = $totalPrice;
            $reservation->guests_num = $numGuests;
            $reservation->guests_Fee = $total_numGuestFee;
            $reservation->extra_bed = $extraBed;
            $reservation->save();

        
        return view('frontdesk.reservation');
       
    }
    
    public function showRoomById(Request $request)
    {
        $room_types = $request->input('room_type');
        $room = Reservations::table('rooms')->select('room_no')->where('room_type', $room_types)->first();
        return view('frontdesk.reservation', ['roomNo' => $room->room_no]);
    }

}