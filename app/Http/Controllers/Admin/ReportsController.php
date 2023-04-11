<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GuestInformation;


class ReportsController extends Controller
{
    public function index(){
        $status = '';
        $checkinDate = '';
        $checkoutDate = '';

        $reports = GuestInformation::join('reservations', 'guest_information.reservation_id', '=', 'reservations.id')
        ->join('manage_rooms', 'reservations.room_id', '=', 'manage_rooms.id')
        ->select('guest_information.reservation_id','guest_information.first_name',
        'guest_information.last_name', 'reservations.booking_status','reservations.nights'
        ,'reservations.checkin_date','reservations.total_price', 'reservations.checkout_date', 'manage_rooms.room_type', 'manage_rooms.room_number')
        ->orderBy('guest_information.first_name', 'asc')
        ->get();
        // ->paginate(10);


        return view('admin.admin_reports', [
            'reports' => $reports,
            'status' => $status,
            'checkinDate' => $checkinDate,
            'checkoutDate' => $checkoutDate,
        ]);
    }

    public function preview(Request $request)
    {
        // Retrieve the input values from the request
        $status = $request->input('status', '');
        $checkinDate = $request->input('checkin_date');
        $checkoutDate = $request->input('checkout_date');

        if ($request->has('clear')) {
            return redirect()->route('admin.reports.clear');
        }
        // Retrieve the filtered orders
        $reports = GuestInformation::leftJoin('reservations', 'guest_information.reservation_id', '=', 'reservations.id')
        ->leftJoin('manage_rooms', 'reservations.room_id', '=', 'manage_rooms.id')
        ->select('guest_information.first_name','guest_information.last_name','reservations.booking_status', 'reservations.checkin_date', 'reservations.checkout_date', 'reservations.total_price', 'reservations.nights', 'manage_rooms.room_number', 'manage_rooms.room_type')
        
        ->when($status, function ($query, $status) {
            return $query->where('reservations.booking_status', $status);
        })
        ->when($checkinDate, function ($query, $checkinDate) {
            return $query->where('reservations.checkin_date', '>=', $checkinDate);
        })
        ->when($checkoutDate, function ($query, $checkoutDate) {
            return $query->where('reservations.checkout_date', '<=', $checkoutDate);
        })
        ->get();
        // ->paginate(10);
        

        // Pass the orders and input values to the view
        return view('admin.admin_reports', [
            'reports' => $reports,
            'status' => $status,
            'checkinDate' => $checkinDate,
            'checkoutDate' => $checkoutDate,
        ]);
    }

public function printPDF(Request $request)
{
    // Retrieve the input values from the request
    $status = $request->input('status', '');
    $checkinDate = $request->input('checkin_date');
    $checkoutDate = $request->input('checkout_date');

    // Retrieve the filtered orders
    $reports = GuestInformation::leftJoin('reservations', 'guest_information.reservation_id', '=', 'reservations.id')
        ->leftJoin('manage_rooms', 'reservations.room_id', '=', 'manage_rooms.id')
        ->select('guest_information.first_name', 'guest_information.last_name', 'reservations.booking_status', 'reservations.checkin_date', 'reservations.checkout_date', 'reservations.total_price', 'reservations.nights', 'manage_rooms.room_number', 'manage_rooms.room_type')
        ->when($status, function ($query, $status) {
            return $query->where('reservations.booking_status', $status);
        })
        ->when($checkinDate, function ($query, $checkinDate) {
            return $query->where('reservations.checkin_date', '>=', $checkinDate);
        })
        ->when($checkoutDate, function ($query, $checkoutDate) {
            return $query->where('reservations.checkout_date', '<=', $checkoutDate);
        })
        ->get();

    // Pass the orders and input values to the view
    $data = [
        'reports' => $reports,
        'date' => date('d/m/Y'),
        // 'image_url' => public_path('images/DWCCLOGO.png'),
    ];

    $pdf = PDF::loadView('admin.admin_reports-details', $data)
    ->setPaper('letter', 'landscape');

    return $pdf->stream();

   
}


    // public function printPDF(Request $request){
    //     // Retrieve the input values from the request
    //     $status = $request->input('status', '');
    //     $checkinDate = $request->input('checkin_date');
    //     $checkoutDate = $request->input('checkout_date');

    //     // Retrieve the filtered orders
    //      $reports = GuestInformation::leftJoin('reservations', 'guest_information.reservation_id', '=', 'reservations.id')
    //     ->leftJoin('manage_rooms', 'reservations.room_id', '=', 'manage_rooms.id')
    //     ->select('guest_information.first_name','guest_information.last_name','reservations.booking_status', 'reservations.checkin_date', 'reservations.checkout_date', 'reservations.total_price', 'reservations.nights', 'manage_rooms.room_number', 'manage_rooms.room_type')
        
    //     ->when($status, function ($query, $status) {
    //         return $query->where('reservations.booking_status', $status);
    //     })
    //     ->when($checkinDate, function ($query, $checkinDate) {
    //         return $query->where('reservations.checkin_date', '>=', $checkinDate);
    //     })
    //     ->when($checkoutDate, function ($query, $checkoutDate) {
    //         return $query->where('reservations.checkout_date', '<=', $checkoutDate);
    //     })
    //     ->get();

    //      // Pass the orders and input values to the view


    //     $pdf = PDF::loadView('admin.admin_reports-details', [
    //         'reports' => $reports,
    //     ]);

    //     return $pdf->stream();
    // }
}
