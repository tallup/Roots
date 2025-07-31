<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;
    
    protected $table = 'component';
    protected $primaryKey = 'compId';
    public $timestamps = false;
    
    protected $fillable = [
        'component_name',
        'addedby'
    ];
} 