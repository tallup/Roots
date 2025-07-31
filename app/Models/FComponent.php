<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FComponent extends Model
{
    protected $table = 'fcomponent';
    protected $primaryKey = 'comid';
    public $timestamps = false;
    protected $fillable = [
        'component', 'component_desc', 'C_allocation', 'C_allocation_balance', 'addedby'
    ];
} 