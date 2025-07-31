<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    use HasFactory;
    
    protected $table = 'contractor';
    protected $primaryKey = 'contractorId';
    public $timestamps = false;
    
    protected $fillable = [
        'contractorName',
        'contact',
        'address',
        'actorId',
        'addedby'
    ];

    public function actor()
    {
        return $this->belongsTo(Actor::class, 'actorId', 'Actor_name');
    }
} 