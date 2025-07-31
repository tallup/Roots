<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubComponent extends Model
{
    use HasFactory;

    protected $table = 'fsubcomponent';
    protected $primaryKey = 'subid';

    protected $fillable = [
        'subcomponent',
        'sub_desc',
        'allocation',
        'allocation_balance',
        'addedby'
    ];

    public $timestamps = false;

    // Relationship with User (admin who added the sub-component)
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'addedby');
    }
} 