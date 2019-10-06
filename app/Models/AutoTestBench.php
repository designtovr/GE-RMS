<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutoTestBench extends Model
{
    protected $table = 'auto_test_bench';

    public $timestamps = false;

    protected $hidden = [
    	'created_at',
    	'created_by',
    ];
}
