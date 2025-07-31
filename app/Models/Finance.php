<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;
    
    protected $table = 'tblfinance';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    
    protected $fillable = [
        'Name',
        'address',
        'username',
        'mobileNo',
        'email',
        'password'
    ];
    
    protected $hidden = [
        'password',
    ];
} 