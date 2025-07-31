<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;
    
    protected $table = 'actor';
    protected $primaryKey = 'actorId';
    public $timestamps = false;
    
    protected $fillable = [
        'Actor_name',
        'addedby'
    ];
} 