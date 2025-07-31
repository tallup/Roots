<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFrequency extends Model
{
    use HasFactory;
    
    protected $table = 'project_freq';
    protected $primaryKey = 'proId';
    public $timestamps = false;
    
    protected $fillable = [
        'Rep_frequency',
        'addedby'
    ];
} 