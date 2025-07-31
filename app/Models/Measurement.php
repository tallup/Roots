<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    use HasFactory;
    
    protected $table = 'measurement';
    protected $primaryKey = 'meauId';
    public $timestamps = false;
    
    protected $fillable = [
        'unit',
        'description',
        'addedby'
    ];
} 