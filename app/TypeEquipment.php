<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeEquipment extends Model
{
    
    protected $table = 'type_equipment';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

}
