<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTranche extends Model
{
    use HasFactory;
    
    protected $table = 'payment_tranche';
    protected $primaryKey = 'trancheId';
    public $timestamps = false;
    
    protected $fillable = [
        'pay_tranche',
        'addedby'
    ];
} 