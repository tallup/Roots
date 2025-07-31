<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    
    protected $table = 'tbladmin';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    
    protected $fillable = [
        'AdminName',
        'UserName',
        'MobileNumber',
        'Email',
        'Password',
        'addedby'
    ];
    
    protected $hidden = [
        'Password',
    ];
}
