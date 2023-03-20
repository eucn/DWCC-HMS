<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontdeskController;
use App\Http\Controllers\Admin\MRoomController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Admin\ManageRoomController;
use App\Http\Controllers\Guest\GuestInvoiceController;
use App\Http\Controllers\FrontdeskReservationController;
use App\Http\Controllers\Guest\GuestInformationController;
use App\Http\Controllers\Guest\GuestReservationController;
use App\Models\Manage_Room;
use App\Http\Controllers\Guest\PDFController;
use App\Http\Controllers\Admin\BookingHistoryController;

/*


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//-------------- Admin Routes --------------//
Route::prefix('admin')->group(function (){
    Route::get('/login',[AdminController::class, 'Index'])->name('login_form');
    Route::post('/login/owner',[AdminController::class, 'Login'])->name('admin.login');
    // Hindi pwedeng maview ang dashboard ng admin hanggat di nag login dahil nilagyan ko sya ng middleware
    Route::get('/dashboard',[AdminController::class, 'Dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/logout',[AdminController::class, 'AdminLogout'])->name('admin.logout')->middleware('admin');

    Route::get('/register', [AdminController::class, 'AdminRegister'])->name('admin.register');
    Route::post('/register/create',[AdminController::class, 'AdminRegisterCreate'])->name('admin.register.create');

    // Change Password Route for Admin
    Route::get('/change-password', [AdminController::class, 'showChangePasswordForm'])->name('admin.changePassword');
    Route::post('/change-password', [AdminController::class, 'updatePassword'])->name('admin.updatePassword');

    // View of List Users
    Route::get('/guest-list', [AdminController::class, 'GuestList'])->name('admin.guestList');
    Route::get('/frontdesk-list', [AdminController::class, 'FrontdeskList'])->name('admin.frontdeskList');
    Route::get('/room-list', [AdminController::class, 'Rooms'])->name('admin.roomList');

    // Create Frontdesk
    
  

    // Manage Rooms
    Route::prefix('room')->group(function () {
            Route::get('/', [ManageRoomController::class, 'index'])->name('admin.room.index')->middleware('admin');
             Route::get('/create', [ManageRoomController::class, 'create'])->name('admin.room.create');
            Route::post('/', [ManageRoomController::class, 'store'])->name('admin.room.store');
            // Route::get('/{room}', [ManageRoomController::class, 'show'])->name('admin.room.show');
            Route::get('/room/edit', [ManageRoomController::class, 'edit'])->name('admin.room.edit');
            Route::put('/{room}', [ManageRoomController::class, 'update'])->name('admin.room.update');
            Route::delete('/{room}', [ManageRoomController::class, 'destroy'])->name('admin.room.destroy');
            Route::put('/{room}', [ManageRoomController::class, 'update'])->name('admin.room.update');

    Route::prefix('booking-history')->group(function () {
            Route::get('/', [BookingHistoryController::class, 'index'])->name('admin.bookingHistory')->middleware('admin');;
            Route::get('/filter', [BookingHistoryController::class, 'filter'])->name('admin.filter-history');
        });
          

            // Route::delete('/admin_delete-rooms/{id}', [ManageRoomController::class, 'destroy'])->name('admin_delete-rooms.destroy');

        });

    // Rooms
//     Route::prefix('room')->group(function (){
//         Route::resource('/', MRoomController::class)->name('admin.room.index');
//         Route::resource('/', MRoomController::class)->names([
//     'index' => 'admin.admin_manage-rooms',
//     'create' => 'rooms.create',
//     'store' => 'rooms.store',
//     'show' => 'rooms.show',
//     'edit' => 'rooms.edit',
//     'update' => 'rooms.update',
//     'destroy' => 'rooms.destroy',
// ]);

//     });
});
//-------------- End Admin Routes --------------//



//-------------- Frontdesk Routes --------------//
Route::prefix('frontdesk')->group(function(){
    Route::get('/login',[FrontdeskController::class, 'Index'])->name('frontdesk_login_form');
    Route::post('/login/owner',[FrontdeskController::class, 'FrontdeskLogin'])->name('frontdesk.login');
    // Hindi pwedeng maview ang dashboard ng admin hanggat di nag login dahil nilagyan ko sya ng middleware
    Route::get('/dashboard',[FrontdeskController::class, 'Dashboard'])->name('frontdesk.dashboard')->middleware('frontdesk');
    Route::get('/logout',[FrontdeskController::class, 'FrontdeskLogout'])->name('frontdesk.logout')->middleware('frontdesk');
    Route::get('/register', [FrontdeskController::class, 'FrontdeskRegister'])->name('frontdesk.register');
    Route::post('/register/create',[FrontdeskController::class, 'FrontdeskRegisterCreate'])->name('frontdesk.register.create');
    Route::get('/reservation/view', [FrontdeskController::class, 'FrontdeskReservation'])->name('frontdesk.reservation');
    Route::post('/reservation/create/roomid', [FrontdeskController::class, 'GetRoomID'])->name('frontdesk.reservation.create');
    Route::post('/reservation', [FrontdeskController::class, 'FrontdeskReservationSave'])->name('frontdesk.reservation.save');
    Route::get('/bookingdetails', [FrontdeskController::class, 'FrontdeskBookingDetails'])->name('frontdesk.bookingdetails');
    Route::post('/update-booking-status/{reservation_Id}',  [FrontdeskController::class, 'updateBookingStatus'])->name('frontdesk.bookingstatus');
    Route::get('/reports', [FrontdeskController::class, 'FrontdeskReports'])->name('frontdesk.reports');
    Route::get('/payment', [FrontdeskController::class, 'FrontdeskPayment'])->name('frontdesk.payment');
});
//-------------- End Frontdesk Routes --------------//

//-------------- Guest Routes --------------//
Route::post('/dashboard', [GuestController::class, 'GuestReservation'])->middleware(['auth', 'verified'])->name('store.date');
Route::get('/dashboard', [GuestController::class, 'ViewDashboard'])->name('guest.dashboard');
Route::post('/userGuest/room_info/{room_id}', [GuestReservationController::class, 'GuestViewRoom'])->name('view.room');
Route::post('/userGuest/guest_registration', [GuestReservationController::class, 'GuestSaveReserve'])->name('save.reservation');
Route::get('/userGuest/guest_registration', [GuestReservationController::class, 'ViewGuestInfo'])->name('registration.form');
Route::post('/userGuest/guest_information', [GuestInformationController::class, 'GuestInfo'])->name('save.guest.info');
Route::post('/userGuest/invoice', [GuestInformationController::class, 'GuestInfo'])->name('save.invoice');
Route::get('/guest_users/invoice', [GuestInvoiceController::class, 'view_invoice'])->name('view.invoice');

//-------------- End Guest Routes --------------//

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
