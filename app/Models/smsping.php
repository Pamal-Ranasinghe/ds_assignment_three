<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsPing extends Model
{
    use HasFactory;

    protected $table = 'sms_pings';

    protected $fillable = [
        'ping',
        'phone_number',

    ];
}
