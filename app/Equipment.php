<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{

    protected $table = 'equipment';
    protected $primary_key = 'id';
    protected $fillable = ['user_id', 'name', 'network_name', 'tag_name', 'ip', 'manufacturer_id', 'type_id', 'model', 'serial_number', 'note'];

    public function getUser()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function getManufacturer()
    {
        return $this->hasOne('App\Manufacturer', 'id', 'manufacturer_id');
    }

    public function getTypeEquipment()
    {
        return $this->hasOne('App\TypeEquipment', 'id', 'type_id');
    }

    public function getManufacturerFormatted()
    {
        if($this->manufacturer_id != null){
            return $this->getManufacturer->name;
        } else {
            return 'Não informado';
        }
    }

    public function getTypeEquipmentFormatted()
    {
        if($this->type_id != null){
            return $this->getTypeEquipment->name;
        } else {
            return 'Não informado';
        }
    }

}
