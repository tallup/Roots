<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FTransaction extends Model
{
    protected $table = 'ftransaction';
    protected $primaryKey = 'id'; // Assuming 'id' is the PK, update if different
    public $timestamps = false;
    protected $fillable = [
        'comid', 'compid', 'comdesc', 'subcom', 'yr', 'qtr', 'outp', 'outAm', 'bal', 'usr', 'entdate'
    ];
} 