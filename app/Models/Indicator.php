<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    use HasFactory;
    
    protected $table = 'indicator';
    protected $primaryKey = 'indicatorId';
    public $timestamps = false;
    
    protected $fillable = [
        'indicator_type',
        'addedby'
    ];
} 