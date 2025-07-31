<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disbursement extends Model
{
    protected $table = 'disbursement';
    protected $primaryKey = 'disburs_id';
    public $timestamps = false;
    protected $fillable = [
        'year', 'quarter', 'disburs_source', 'comp_id', 'subcomp', 'comp_three', 'total_budjet', 'querter_taeget', 'actual', 'commit', 'perfor', 'execu', 'admstatus'
    ];
} 