<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';
    protected $primaryKey = 'id';
    protected $fillable = ['message', 'ticket_id', 'user_id', 'read'];

    public function getTicket()
    {
        return $this->hasOne('App\Ticket', 'id', 'ticket_id');
    }

    public function getUser()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function getColor($key)
    {
        if($key % 2 == 0){
            return 'btn-info';
        } else if($key % 3 == 0){
            return 'btn-danger';
        } else {
            return 'btn-warning';
        }
    }

}
