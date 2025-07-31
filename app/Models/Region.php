<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    
    protected $table = 'region';
    protected $primaryKey = 'regId';
    public $timestamps = false;
    
    protected $fillable = [
        'region_initial',
        'region_name',
        'addedby'
    ];
}
