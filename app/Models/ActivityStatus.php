<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityStatus extends Model
{
    use HasFactory;

    protected $table = 'status';
    protected $primaryKey = 'stuId';
    public $timestamps = false;

    protected $fillable = [
        'activ_status',
        'addedby',
    ];
} 