<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractType extends Model
{
    use HasFactory;
    
    protected $table = 'contract_type';
    protected $primaryKey = 'ctyId';
    public $timestamps = false;
    
    protected $fillable = [
        'contractType',
        'addedby'
    ];
} 