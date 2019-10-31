<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aging extends Model
{
    protected $table = 'aging';

    protected $hidden = [
    	'created_at',
    	'created_by',
    ];
}
