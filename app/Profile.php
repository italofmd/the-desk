<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id', 'cpf', 'zipcode', 'neighborhood', 'street', 'number', 'complement', 'telephone', 'cellphone', 'whatsapp', 'gender_id', 'marital_id', 'city_id' ];

    public function getUser()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function getGender()
    {
        return $this->hasOne('App\Gender', 'id', 'gender_id');
    }

    public function getMarital()
    {
        return $this->hasOne('App\Marital', 'id', 'marital_id');
    }

    public function getCity()
    {
        return $this->hasOne('App\City', 'id', 'city_id');
    }

    public function getStateIdFormatted()
    {
        if($this->city_id == null){
            return null;
        } else {
            return $this->getCity->state_id;
        }
    }
}
