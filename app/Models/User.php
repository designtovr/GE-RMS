<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Roles()
    {
        return $this->hasOne(RoleUser::class, 'user_id');
    }

    public function isAdmin() {
       return $this->Roles()->where('role_id', 1)->exists();
    }

    public function isManager() {
        return $this->Roles()->where('role_id', 2)->exists();
    }

    public function isTechnician() {
        return $this->Roles()->where('role_id', 3)->exists();
    }

    public function Role()
    {
        if($this->isAdmin())
        {
            return 1;
        }
        else if($this->isManager())
        {
            return 2;
        }
        else if($this->isTechnician())
        {
            return 3;
        }
        else
        {
            return 0;
        }
    }
}
