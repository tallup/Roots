<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    
    protected $table = 'tblclient';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    
    protected $fillable = [
        'CompanyName',
        'Address',
        'region_name',
        'Workphnumber',
        'Email',
        'Password',
        'uid',
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