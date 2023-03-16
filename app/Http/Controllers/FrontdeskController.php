<?php

namespace App\Http\Controllers;

use App\Models\Frontdesk;

//Login
use Illuminate\View\View;
use App\Models\Reservations;
use App\Models\Walkin_Reservations;
use App\Models\Manage_Room;
use Illuminate\Http\Request;
use App\Models\GuestInformation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

//Register
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\Rules\Password;

class FrontdeskController extends Controller
{
    public function Index(){
        return view('frontdesk.frontdesk_login');
    }

    public function Dashboard(){
        return view('frontdesk.frontdesk_dashboard');
    }

    //Handle an incoming login request.
    public function FrontdeskLogin(LoginRequest $request): RedirectResponse
    {
        $request->authenticate_Frontdesk();

        $request->session()->regenerate();

        return redirect()->route('frontdesk.dashboard');
    }

    //Destroy an authenticated session or Logout.
    public function FrontdeskLogout(Request $request): RedirectResponse
    {
        Auth::guard('frontdesk')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('frontdesk_login_form');
        // return redirect('/frontdesk/login');
    }

    //Display the registration view.
    public function FrontdeskRegister(){
        return view('frontdesk.frontdesk_register');
    }

    //Handle an incoming registration request.
    public function FrontdeskRegisterCreate(Request $request): RedirectResponse {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Frontdesk::class],
            'password' => ['required', 'confirmed', 
            Password::min(8)->letters()->numbers()->mixedCase()->symbols()],
        ]);

        $frontdesk = Frontdesk::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($frontdesk));
        // return redirect('/frontdesk/login');
        return redirect()->route('#');
    }
    public function FrontdeskReservation(){
        $room_type = Manage_Room::distinct()->pluck('room_type');
        return view('frontdesk.frontdesk_reservation', compact('room_type'));
    }
    public function GetRoomID(Request $request)
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
            $checkoutdateSave = date('Y-m-d', strtotime($checkout_date));

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
  
    public function FrontdeskBookingDetails(){
        $reservations = GuestInformation::join('reservations', 'guest_information.reservation_id', '=', 'reservations.id')
        ->join('manage_rooms', 'reservations.room_id', '=', 'manage_rooms.id')
        ->select('guest_information.first_name','guest_information.last_name', 'guest_information.payment_method','reservations.booking_status', 'reservations.checkin_date','reservations.total_price', 'reservations.checkout_date',)
        ->get();
        return view('frontdesk.frontdesk_bookingdetails', [
            'reservationData' => $reservations,
        ]);
    }
    public function FrontdeskReports(){
        return view('frontdesk.frontdesk_reports');
    }
    public function FrontdeskPayment(){
        return view('frontdesk.frontdesk_payment');
    }
    }
