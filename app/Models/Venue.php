<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;
    
    protected $table = 'venue';
    protected $primaryKey = 'venId';
    public $timestamps = false;
    
    protected $fillable = [
        'venue_name',
        'venue_address',
        'addedby'
    ];
} 