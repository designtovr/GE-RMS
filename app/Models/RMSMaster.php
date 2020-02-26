<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Formattedids;

class RMSMaster extends Model
{
	use Formattedids;
    protected $table = 'rms';

    public function getFormattedPvIdAttribute()
    {
    	return $this->FormatPvId($this->pv_id);
    }

    protected $appends = [
    	'formatted_pv_id'
    ];
}