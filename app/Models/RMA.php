<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Formattedids;

class RMA extends Model
{
	use Formattedids;
    protected $table = 'rma';

    public function getFormattedRMAIdAttribute()
    {
    	return $this->FormatRMAId($this->id);
    }

    public function getFormattedReceiptIdAttribute()
    {
    	return $this->FormatReceiptId($this->receipt_id);
    }

    protected $appends = [
    	'formatted_rma_id',
    	'formatted_receipt_id'
    ];
}
