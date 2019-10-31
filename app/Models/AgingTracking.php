<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgingTracking extends Model
{
    protected $table = 'aging_tracking';

    public $timestamps = false;

    protected $hidden = [
    	'created_at',
    	'created_by',
    ];
}
