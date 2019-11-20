<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Formattedids;

class PhysicalVerificationMaster extends Model
{
	use Formattedids;
    protected $table = 'physical_verification';

    protected $fillable = [

    ];

    protected $hidden = [
    	'created_at',
    	'updated_at',
    	'created_by',
    	'updated_by'
    ];

    public function getFormattedPvIdAttribute()
    {
    	if ($this->pv_id != null)
    		return $this->FormatPvId($this->pv_id);
    	return $this->FormatPvId($this->id);
    }

    public function getFormattedReceiptIdAttribute()
    {
    	return $this->FormatReceiptId($this->receipt_id);
    }

    public function getFormattedRMAIdAttribute()
    {
    	$RMA = RMA::where('receipt_id', $this->receipt_id)->first();
    	if ($RMA)
    		return $this->FormatRMAId($RMA->id);
    	else
    		return '';
    }

    protected $appends = [
    	'formatted_receipt_id',
    	'formatted_rma_id',
    	'formatted_pv_id'
    ];
}
