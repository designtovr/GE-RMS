<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhysicalVerificationMaster extends Model
{
    protected $table = 'physical_verification';

    protected $fillable = [

    ];

    protected $hidden = [
    	'created_at',
    	'updated_at',
    	'created_by',
    	'updated_by'
    ];
}
