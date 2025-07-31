<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicatorDescription extends Model
{
    use HasFactory;
    
    protected $table = 'indicator_desc';
    protected $primaryKey = 'descid';
    public $timestamps = false;
    
    protected $fillable = [
        'indi_id',
        'description',
        'addedby'
    ];

    public function indicator()
    {
        return $this->belongsTo(Indicator::class, 'indi_id', 'indicatorId');
    }
} 