<?php

namespace App\Http\Controllers;

//Default
use Illuminate\Http\Request;

//Login
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

//Register
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Auth\Events\Registered;
use App\Models\Admin;

//Count users
use App\Models\User;
use App\Models\Frontdesk;
use App\Models\Manage_Room;
use Illuminate\Support\Facades\DB;

//Change Password
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    //Display the login view.
    public function Index(){

        return view('admin.admin_login');
    }

    //Display the dashboard view.
    public function Dashboard(){
        $totalGuest = DB::table('users')->count();
        $totalFrontdesk = DB::table('frontdesks')->count();
        $totalRoom = DB::table('manage_rooms')->count();

        return view('admin.admin_dashboard', compact('totalGuest', 'totalFrontdesk', 'totalRoom'));
    }

    // public function Login(Request $request){
    //     // dd($request->all());

    //     $check = $request->all();
    //     if(Auth::guard('admin')->attempt(['email' => $check['email'], 'password' => $check['password']])){
    //         return redirect()->route('admin.dashboard')->with('error', 'Admin login successfully');
    //     }
    //     else{
    //         return back();
    //     }
    // }

    //Handle an incoming login request.
    public function Login(LoginRequest $request): RedirectResponse
    {
        $request->authenticate_Admin();

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    //Destroy an authenticated session or Logout.
    public function AdminLogout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login_form');
        // return redirect('/admin/login');
    }

    //Display the registration view.
    public function AdminRegister(){
        return view('admin.admin_register');
    }

    //Handle an incoming registration request.
    public function AdminRegisterCreate(Request $request): RedirectResponse {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Admin::class],
            'password' => ['required', 'confirmed', 
            Password::min(8)->letters()->numbers()->mixedCase()->symbols()],
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($admin));
        return redirect('/admin/login');
    }

    // Display Change Password view
    // public function showChangePasswordForm(){
    //     return view('admin.admin_changePassword');
    // }
    public function showChangePasswordForm(Request $request): View
    {
        return view('admin.admin_changePassword', ['request' => $request]);
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }


    // View List of guest users
    public function GuestList(){
        $users = User::all();
        return view('admin.admin_view-guest-users', ['users' => $users]);
    }

    // View List of Frontdesk Users
    public function FrontdeskList(){
        $frontdesks = Frontdesk::all();
        return view('admin.admin_view-frontdesk-users', ['frontdesks' => $frontdesks]);
    }

    // View List of Rooms
    public function Rooms(){
        $rooms = Manage_Room::all();
        return view('admin.admin_manage-rooms', ['rooms' => $rooms]);
    }
   
    
            public function store(Request $request)
            {
                $validatedData = $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Frontdesk::class],
                    'password' => ['required', 'confirmed'],
                ]);
                $requestData = $request->all();
                $fileName = time().$request->file('photos')->getClientOriginalName();
                Manage_Room::create($requestData);
                return redirect()->route('admin.frontdesk-List.index')->with('success', 'The record has been successfully added.');
            }
        }
