<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;
    
    protected $table = 'training';
    protected $primaryKey = 'traId';
    public $timestamps = false;
    
    protected $fillable = [
        'type',
        'addedby'
    ];
} 