<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = [
        'type', 'user_id',
        'no_of_people', 'hotel', 'date_of_reservation', 'start_date', 'end_date', 'payment_status', 'room_type',
        'package_id', 'full_name', 'passport_number', 'passport_file',
        'religious_id', 'religious_name', 'tour_type', 'no_of_members', 'transfer_date', 'transfer_time', 'transfer_payment_status', 'religious_guide',
    ];
}
