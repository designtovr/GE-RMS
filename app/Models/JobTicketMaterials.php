<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobTicketMaterials extends Model
{
    protected $table = 'job_ticket_materials';
    
    protected $hidden = [
    	'created_at',
    	'updated_at',
    	'created_by',
    	'updated_by'
    ];
}
