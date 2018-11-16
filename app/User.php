<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'type_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {        
        $this->notify(new ResetPassword($token));
    }

    public function getTypeUser()
    {
        return $this->hasOne('App\TypeUser', 'id', 'type_id');
    }

    public function getProfile()
    {
        return $this->hasOne('App\Profile', 'user_id', 'id');
    }

    public function getNameFormatted()
    {
        return shortName($this->name);
    }

    public function getFirstNameFormatted()
    {
        return firstName($this->name);
    }
}