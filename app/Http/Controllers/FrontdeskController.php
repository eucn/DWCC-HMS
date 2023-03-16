<?php

namespace App\Http\Controllers;

use App\Models\Frontdesk;

//Login
use Illuminate\View\View;
use App\Models\Reservations;
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
