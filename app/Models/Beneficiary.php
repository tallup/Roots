<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;
    
    protected $table = 'beneficiary';
    protected $primaryKey = 'benId';
    public $timestamps = false;
    
    protected $fillable = [
        'beneficiary_type',
        'addedby'
    ];
}
