<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GuestInformation;

class ReportsController extends Controller
{
    public function index(){
        $reports = GuestInformation::join('reservations', 'guest_information.reservation_id', '=', 'reservations.id')
        ->join('manage_rooms', 'reservations.room_id', '=', 'manage_rooms.id')
        ->select('guest_information.reservation_id','guest_information.first_name',
        'guest_information.last_name', 'reservations.booking_status','reservations.nights'
        ,'reservations.checkin_date','reservations.total_price', 'reservations.checkout_date', 'manage_rooms.room_type', 'manage_rooms.room_number')
        ->orderBy('guest_information.first_name', 'asc')
        ->get();

        return view('admin.admin_reports', [
            'reports' => $reports,
        ]);

    }
}
