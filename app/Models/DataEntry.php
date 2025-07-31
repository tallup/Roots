<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataEntry extends Model
{
    use HasFactory;
    
    protected $table = 'dataentry';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    
    protected $fillable = [
        'CompanyName',
        'Address',
        'Workphnumber',
        'Email',
        'Password',
        'uid',
        'region_name',
        'remember_token',
        'last_login',
        'login_count'
    ];
    
    protected $hidden = [
        'Password',
        'remember_token',
    ];
    
    protected $casts = [
        'CreationDate' => 'datetime',
        'last_login' => 'datetime',
    ];
} 