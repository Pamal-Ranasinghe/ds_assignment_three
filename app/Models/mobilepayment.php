<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobilePayment extends Model
{
    
    use HasFactory;

    protected $table = 'mobile_payments';

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'amount',
    ];
}
