<?php

/**
 * 
 * Model Class
 * User, all users
 * 
 */

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\VerifyEmail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'token', 'provider', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function verified(){
        return $this->token == null;
    }

    public function sendEmailNotification(){
        $this->notify(new VerifyEmail($this));
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }
}
