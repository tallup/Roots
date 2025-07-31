<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMode extends Model
{
    use HasFactory;
    
    protected $table = 'payment_mode';
    protected $primaryKey = 'payId';
    public $timestamps = false;
    
    protected $fillable = [
        'pay_mode',
        'addedby'
    ];
} 