<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aging extends Model
{
    protected $table = 'aging';

    public $timestamps = false;

    protected $hidden = [
    	'created_at',
    	'created_by',
    ];
}
