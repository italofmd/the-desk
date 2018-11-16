<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
    
    protected $table = 'ticket_category';
    protected $fillable = ['name'];
    protected $primaryKey = 'id';

}
