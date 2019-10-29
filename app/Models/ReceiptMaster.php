<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiptMaster extends Model
{
    protected $table = 'receipt';

    protected $fillable = [

    ];

    public function Customer()
    {
    	return $this->hasOne(CustomerMaster::class, 'id', 'customer_id');
    }

}
