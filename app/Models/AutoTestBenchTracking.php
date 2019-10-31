<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutoTestBenchTracking extends Model
{
    protected $table = 'auto_test_bench_tracking';

    public $timestamps = false;

    protected $hidden = [
    	'created_at',
    	'created_by',
    ];
}
