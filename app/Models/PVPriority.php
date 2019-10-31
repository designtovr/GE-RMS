<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PVPriority extends Model
{
    protected $table = 'pv_priority_list';

    public $hidden = [
    	'created_at',
    	'created_by',
    	'updated_at',
    	'updated_by'
    ];
}
