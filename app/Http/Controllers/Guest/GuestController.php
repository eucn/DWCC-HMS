<?php
namespace App\Http\Controllers\Guest;
use DateTime;

use Carbon\Carbon;
use App\Models\Manage_Room;
use App\Models\Reservations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuestController extends Controller

{    
    public function GuestReservation(Request $request)
    { 
        $errorsArray = [];
        $request->validate([
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
        ], [
            'check_in_date.required' => 'The check-in date is required.',
            'check_in_date.after_or_equal' => 'The check-in date must be today or later.',
            'check_out_date.required' => 'The check-out date is required.',
            'check_out_date.after' => 'The check-out date must be after the check-in date.',
        ]);
    
        $checkInDate = $request->input('check_in_date');
        $checkOutDate = $request->input('check_out_date');    
        $numberOfNights = $request->input('number_of_nights');
      
        $request->session()->put('check_in_date', $checkInDate);
        $request->session()->put('check_out_date', $checkOutDate);
        $request->session()->put('number_of_nights', $numberOfNights);

        $roomIds = Manage_Room::pluck('id');
        $reservedRoomIds = Reservations::where(function($query) use ($checkInDate, $checkOutDate) {
            $query->whereBetween('checkin_date', [$checkInDate, $checkOutDate])
                  ->orWhereBetween('checkout_date', [$checkInDate, $checkOutDate]);
        })->pluck('room_id')->toArray();
        
        if (count(array_diff($roomIds->toArray(), $reservedRoomIds)) == 0) {
            $errorsArray[] = 'No available room(s) from the selected dates due to its occupancy. You may try to select another date';
        }
        
        if (!empty($errorsArray)) {
            return back()->withErrors($errorsArray)->withInput();
        }
        // Show the Description of Rooms
        return redirect()->route('guest.dashboard');
    }
    public function ViewDashboard(Request $request){
        $rooms = Manage_Room::all();
          // Format the session date using the date() function
          
        $checkin_date = session('check_in_date');
        $checkout_date = session('check_out_date');
    
        if (!$checkin_date || !$checkout_date) {
            return view('dashboard', [
                'rooms' => $rooms,
                'isRoomReserved' => array_fill_keys($rooms->pluck('id')->toArray(), true),
                'checkin_date' => $checkin_date,
                'checkout_date' => $checkout_date,
                'displayImage' => true,
            ]);
        } else {
            $isRoomReserved = [];
            foreach ($rooms as $room) {
                $isRoomReserved[$room->id] = $this->isRoomReserved($room->id, $checkin_date, $checkout_date);
            }
            return view('dashboard', [
                'rooms' => $rooms,
                'isRoomReserved' => $isRoomReserved,
                'checkin_date' => $checkin_date,
                'checkout_date' => $checkout_date,
                'displayImage' => false,
            ]);
        }
        
    }
    public function isRoomReserved($roomTypeId, $checkin_date, $checkout_date)
    {
        if (!$checkin_date || !$checkout_date) {
            // If check-in or check-out dates are not set, return true to disable the button
            return true;
        }
        $checkInDateObj = new \DateTime($checkin_date);
        $checkOutDateObj = new \DateTime($checkout_date);
    
        $reservations = Reservations::where('room_id', $roomTypeId)
            ->where(function ($query) use ($checkInDateObj, $checkOutDateObj) {
                $query->whereBetween('checkin_date', [$checkInDateObj, $checkOutDateObj])
                    ->orWhereBetween('checkout_date', [$checkInDateObj, $checkOutDateObj])
                    ->orWhere(function ($query) use ($checkInDateObj, $checkOutDateObj) {
                        $query->where('checkin_date', '<=', $checkInDateObj)
                            ->where('checkout_date', '>=', $checkOutDateObj);
                    });
            })->get();
    
        return count($reservations) > 0;
    }
    
    
}
