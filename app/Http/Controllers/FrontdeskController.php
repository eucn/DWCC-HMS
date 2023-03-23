<?php

namespace App\Http\Controllers;

use App\Models\Frontdesk;

//Login
use Illuminate\View\View;
use App\Models\Manage_Room;
use App\Models\Reservations;
use Illuminate\Http\Request;
use App\Models\GuestInformation;
use Illuminate\Support\Facades\DB;
use App\Models\Walkin_Reservations;
use App\Http\Controllers\Controller;

//Register
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
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
        return redirect()->route('admin.frontdeskList');
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
        if (Auth::guard('frontdesk')->check()) {
            $frontdesk_id = Auth::guard('frontdesk')->id();
        } else {
            return abort(401, 'Unauthorized');
        }
    
        // $room_type = $request->input('room_type');
        $room_id = $request->input('room_id');
        $checkin_date = $request->input('check_in_date');
        $checkout_date = $request->input('check_out_date');
    
        $reservations = Reservations::where('room_id', $room_id)
        ->where(function($query) use ($checkin_date, $checkout_date) {
            $query->whereBetween('checkin_date', [$checkin_date, $checkout_date])
                ->orWhereBetween('checkout_date', [$checkin_date, $checkout_date])
                ->orWhere(function($query) use ($checkin_date, $checkout_date) {
                    $query->where('checkin_date', '<', $checkin_date)
                            ->where('checkout_date', '>', $checkout_date);
                });
        })
        ->get();

    if (!$reservations->isEmpty()) {
        // room is already reserved, return an error message or redirect back with an error message
        return redirect()->back()->with('error', 'The room is already reserved for the selected dates.');
    }else{
            $room_id = $request->input('room_no');
            $checkin_date = $request->input('check_in_date');
            $checkout_date = $request->input('check_out_date');
            $extraBed =  $request->input('extra_bed');
            $numGuests = $request->input('guest_num');
            $numNights = $request->input('number_of_nights');
            
            $checkindateSave = date('Y-m-d', strtotime($checkin_date));
            $checkoutdateSave = date('Y-m-d', strtotime($checkout_date));

            $additionalFeePerGuest  = 300;
            $roomPrice = Manage_Room::where('id', $room_id)->value('rate');
            if ($numNights > 1) {
                $total_roomPrice = $roomPrice * $numNights;
            } else {
                $total_roomPrice = $roomPrice;
            }
            $max_capacity = Manage_Room::where('id', $room_id)->value('max_capacity');
            $numAdditionalGuests = $numGuests - $max_capacity;
            if ($numAdditionalGuests > 0 ) {
                $total_numGuestFee = $numAdditionalGuests  *  $additionalFeePerGuest;
            } else{
                $total_numGuestFee  = 0;
            }
            $totalPrice = $total_roomPrice +  $total_numGuestFee;

            $reservation = new Reservations();
            $reservation->frontdesk_id = $frontdesk_id;
            $reservation->room_id = $room_id;
            $reservation->checkin_date = $checkindateSave;
            $reservation->checkout_date = $checkoutdateSave;
            $reservation->nights = $numNights;
            $reservation->booking_status = 'Pending';
            $reservation->booking_types = 'Walk-in';    
            $reservation->base_price = $roomPrice;
            $reservation->total_price = $totalPrice;
            $reservation->guests_num = $numGuests;
            $reservation->additional_guests = $numAdditionalGuests;
            $reservation->guests_Fee = $total_numGuestFee;
            $reservation->save();

            $phone_number = $request->validate([
                'phone_number' => 'required|regex:/^09[0-9]{9}$/',
            ], [
                'phone_number.required' => 'The phone number field is required.',
                'phone_number.regex' => 'The phone number contain 11 digit.'
            ]);
            $reservation_id = Reservations::select('id')->latest('id')->value('id');
            // Validate the request data

            $salutation = $request->input('salutation');
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $company_name = $request->input('company_name');
            $address = $request->input('address');
            $phone_number = $request->input('phone_number');
            $payment_method = $request->input('payment_method');
            $department_id = $request->input('department');

            $salutation = $request->input('salutation');
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $company_name = $request->input('company_name');
            $address = $request->input('address');
            $phone_number = $request->input('phone_number');
            $payment_method = $request->input('payment_method');
            $department_id = $request->input('department');

            $guestInformation = new GuestInformation();
            $guestInformation->frontdesk_id = $frontdesk_id;
            $guestInformation->reservation_id = $reservation_id;
            $guestInformation->salutation = $salutation;
            $guestInformation->first_name = $first_name;
            $guestInformation->last_name = $last_name;  
            $guestInformation->company_name = $company_name;
            $guestInformation->address = $address;
            $guestInformation->phone_number = $phone_number;

            if($payment_method == "Cash"){
                $guestInformation->payment_method = $payment_method;
            }else if($payment_method == "Department Charge"){
                $guestInformation->payment_method = $payment_method;
                if($department_id == "School of Information Technology"){
                    $guestInformation->department = $department_id;
                }else if($department_id == "School of Education"){
                    $guestInformation->department = $department_id;
                }
                else if($department_id == "School of Business and Hospitality and Tourism Management"){
                    $guestInformation->department = $department_id;
                }
                else if($department_id == "School of Engineering and Architechture and Fine Arts"){
                    $guestInformation->department = $department_id;
                }
                else if($department_id == "School of Liberal Arts and Criminal Justice"){
                    $guestInformation->department = $department_id;
                }
            }
            $guestInformation->save();
            
        }
        // Session::flash('success', 'Your reservation was successful.');
        return redirect()->route('frontdesk.invoice.view');

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
        ->select('guest_information.reservation_id','guest_information.first_name','guest_information.last_name', 'guest_information.payment_method','reservations.booking_status', 'reservations.checkin_date','reservations.total_price', 'reservations.checkout_date',)
        ->get();

        return view('frontdesk.frontdesk_bookingdetails', [
            'reservationData' => $reservations,

        ]);
    }
    // SOFT DELETE
    public function softDeletesReservation($reservation_id)
    {
        // $reservations = Reservations::findorFail($reservation_id);
        $reservations = GuestInformation::join('reservations', 'guest_information.reservation_id', '=', 'reservations.id')
        ->join('manage_rooms', 'reservations.room_id', '=', 'manage_rooms.id')
        ->select('guest_information.id', 'reservations.id as reservation_id', 'guest_information.first_name', 'guest_information.last_name', 'guest_information.payment_method',
            'reservations.booking_status', 'reservations.checkin_date', 'reservations.total_price', 'reservations.checkout_date',)
        ->where('guest_information.reservation_id', '=', $reservation_id)
        ->get();
        
        if ($reservations->count() > 0) {
            foreach ($reservations as $reservation) {
                $reservation->delete(); // Soft delete the record
            }
    
            return redirect()->back()->with('success', 'Item soft deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Reservation not found');
        }
    }
   // RESTORE SOFT DELETE ITEMS
    public function viewDeletedGuestInformation()
    {
        $deletedGuestInformation = GuestInformation::withTrashed()->onlyTrashed()->get();
        return view('deleted-guest-information', ['guestInformation' => $deletedGuestInformation]);
    }


    public function FrontdeskReports(){
        return view('frontdesk.frontdesk_reports');
    }
    public function FrontdeskPayment(){
        $reservations = GuestInformation::join('reservations', 'guest_information.reservation_id', '=', 'reservations.id')
        ->join('manage_rooms', 'reservations.room_id', '=', 'manage_rooms.id')
        ->select('guest_information.reservation_id','guest_information.first_name','guest_information.last_name', 'guest_information.payment_method','reservations.booking_types', 'reservations.checkin_date','reservations.total_price', 'reservations.checkout_date',)
        ->get();
        return view('frontdesk.frontdesk_payment', [
            'reservationData' => $reservations,
        ]);
    }
    public function updateBookingStatus(Request $request)
    {
        $reservation_id = $request->input('reservation_id');
        $reservations = Reservations::find($reservation_id);

        if ($reservations) {
        $reservations->booking_status = 'paid';
        $reservations->save();
        return redirect()->back()->with('success', 'Booking status updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Invalid guest information.');
        }
    }

}
