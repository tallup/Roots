<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicatorFrequency extends Model
{
    use HasFactory;

    protected $table = 'indicator_freq';
    protected $primaryKey = 'freqId';
    public $timestamps = false;

    protected $fillable = [
        'frequency_type',
        'addedby',
    ];
} 