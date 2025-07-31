<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    
    protected $table = 'person';
    protected $primaryKey = 'personId';
    public $timestamps = false;
    
    protected $fillable = [
        'Name',
        'actorId',
        'addedby'
    ];

    public function actor()
    {
        return $this->belongsTo(Actor::class, 'actorId', 'actorId');
    }
} 