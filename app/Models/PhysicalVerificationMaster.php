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
    	/*'created_at',
    	'updated_at',
    	'created_by',
    	'updated_by'*/
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
    	$RMAUI = RMAUnitInformation::where('pv_id', $this->id)->first();
        //Job Ticket page formatted data return empty
        //So including the new condition as checking with pv_id
        if(!$RMAUI)
            $RMAUI = RMAUnitInformation::where('pv_id', $this->pv_id)->first();

    	if ($RMAUI)
    		return $this->FormatRMAId($RMAUI->rma_id);
    	else
    		return '';
    }

    protected $appends = [
    	'formatted_receipt_id',
    	'formatted_rma_id',
    	'formatted_pv_id'
    ];

    public function jobticket()
    {
        return $this->hasOne(JobTicket::class, 'pv_id');
    }

    public function rms()
    {
        return $this->hasOne(RMSMaster::class, 'pv_id');
    }
}
