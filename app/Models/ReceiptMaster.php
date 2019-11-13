<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Formattedids;

class ReceiptMaster extends Model
{
	use Formattedids;
    protected $table = 'receipt';

    protected $fillable = [

    ];

    public function Customer()
    {
    	return $this->hasOne(CustomerMaster::class, 'id', 'customer_id');
    }

    public function getFormattedReceiptIdAttribute()
    {
    	return $this->FormatReceiptId($this->id);
    }

    public function getFormattedRMAIdAttribute()
    {
    	$RMA = RMA::where('receipt_id', $this->id)->first();
    	if ($RMA)
    		return $this->FormatRMAId($RMA->id);
    	else
    		return '';
    }

    protected $appends = [
    	'formatted_receipt_id',
    	'formatted_rma_id'
    ];

}
