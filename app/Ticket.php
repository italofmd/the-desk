<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ticket extends Model
{
    
    protected $table = 'ticket';
    protected $primaryKey = 'id';
    protected $fillable = ['subject', 'description', 'file', 'file_name', 'path', 'conclusion_date', 'priority_id', 'status_id', 'equipment_id', 'category_id', 'user_id', 'agent_id'];

    public function getUser()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function getAgent()
    {
        return $this->hasOne('App\User', 'id', 'agent_id');
    }

    public function getPriority()
    {
        return $this->hasOne('App\Priority', 'id', 'priority_id');
    }

    public function getStatus()
    {
        return $this->hasOne('App\Status', 'id', 'status_id');
    }

    public function getEquipment()
    {
        return $this->hasOne('App\Equipment', 'id', 'equipment_id');
    }

    public function getCategory()
    {
        return $this->hasOne('App\TicketCategory', 'id', 'category_id');
    }

    public function getIdFormatted()
    {        
        return '#' .str_pad($this->id, 5, 0, STR_PAD_LEFT);
    }

    public function getCreatedAtFormatted()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d/m/Y H:i');
    }

    public function getUpdatedAtFormatted()
    {
        if($this->updated_at != null){
            return Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->format('d/m/Y H:i');
        } else {
            return 'Não atualizado';
        }    
    }

    public function getConclusionDateFormatted()
    {
        if($this->updated_at != null){
            return Carbon::createFromFormat('Y-m-d H:i:s', $this->conclusion_date)->format('d/m/Y H:i');
        } else {
            return 'Não concluído';
        }    
    }

    public function getAgentFormatted()
    {
        if($this->agent_id != null){
            return $this->getAgent->getNameFormatted();
        } else {
            return 'Não definido';
        }
    }

    public function getStatusBadge()
    {
        if($this->status_id == 1){
            return 'badge-warning';
        } else if($this->status_id == 2){
            return 'badge-info';
        } else if($this->status_id == 3){
            return 'badge-success';
        } else {
            return 'badge-danger';
        }
    }

    public function getStatusFormatted()
    {
        return strtoupper($this->getStatus->name);
    }

    public function getStatusColor()
    {
        if($this->status_id == 1){
            return 'text-warning';
        } else if($this->status_id == 2){
            return 'text-info';
        } else if($this->status_id == 3){
            return 'text-success';
        } else {
            return 'text-danger';
        }
    }

    public function getEquipmentFormatted()
    {
        if($this->equipment_id == null){
            return 'Não informado';
        } else {
            return $this->getEquipment->name;
        }
    }

}
