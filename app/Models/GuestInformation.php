<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestInformation extends Model
{
    use HasFactory;
    // protected $fillable = [
    //     'guest_id',
    //     'frontdesk_id',
    //     'reservation_id',
    //     'salutation',
    //     'first_name',
    //     'last_name',
    //     'company_name',
    //     'address',
    //     'phone_number',
    //     'payment_method',
    //     'payment_status',
    //     'department',
    //     'index'
    // ];
    public function reservation()
    {
        return $this->belongsTo(Reservations::class);
    }
}
