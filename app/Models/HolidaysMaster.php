<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HolidaysMaster extends Model
{
    protected $table = 'ma_holidays';

    protected $hidden = [
    	'created_at',
    	'created_by',
    ];
}
