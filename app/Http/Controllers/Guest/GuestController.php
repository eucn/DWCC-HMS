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
        $request->validate([
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
        ], [
            'check_in_date.required' => 'The check-in date is required.',
            'check_out_date.required' => 'The check-out date is required.',
            'check_out_date.after' => 'The check-out date must be after the check-in date.',
        ]);
    // $roomIds = Manage_Room::pluck('id
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
            return back()->withErrors(['message' => 'No available room(s) from the selected dates due to its occupancy. You may try to select another date'])->withInput();
        }
        // Show the Description of Rooms
        return redirect()->route('guest.dashboard');  
    }
    public function ViewDashboard( ){
        $room1 = Manage_Room::where('id', 1)->first();  
        $room2 = Manage_Room::where('id', 2)->first();
        $checkin_date = session('check_in_date');
        $checkout_date = session('check_out_date');
          // Format the session date using the date() function
        $isRoom1Reserved = $this->isRoomReserved($room1->id, $checkin_date, $checkout_date);
        $isRoom2Reserved = $this->isRoomReserved($room2->id, $checkin_date, $checkout_date);
        return view('dashboard',[
            'room1'=>$room1, 
            'room2'=>$room2,
            'isRoom1Reserved'=>$isRoom1Reserved,
            'isRoom2Reserved'=>$isRoom2Reserved,
        ]);
    }
    public function isRoomReserved($roomTypeId, $checkin_date, $checkout_date)
    {
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
