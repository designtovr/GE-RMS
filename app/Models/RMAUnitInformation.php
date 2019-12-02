<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Formattedids;

class RMAUnitInformation extends Model
{
	use Formattedids;
    protected $table = 'rma_unit_information';

    public function getFormattedPvIdAttribute()
    {
    	if ($this->pv_id != null)
    		return $this->FormatPvId($this->pv_id);
    }

    protected $appends = [
    	'formatted_pv_id'
    ];

}
