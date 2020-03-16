<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobTicket extends Model
{
    protected $table = 'job_tickets';

    protected $hidden = [
    	'created_at',
    	'updated_at',
    	'created_by',
    	'updated_by'
    ];

    public function materials()
    {
    	return $this->hasMany(JobTicketMaterials::class, 'jt_id');
    }
}
