<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EquipmentRequest;
use App\Equipment;
use App\Manufacturer;
use App\User;
use App\TypeEquipment;

class EquipmentController extends Controller
{

    protected $user;
    protected $equipment;
    protected $typeEquipment;
    protected $manufacturer;

    public function __construct(Equipment $equipment, User $user, Manufacturer $manufacturer, TypeEquipment $typeEquipment)
    {        
        $this->equipment = $equipment;
        $this->user = $user;
        $this->manufacturer = $manufacturer;
        $this->typeEquipment = $typeEquipment;
    }

    public function showIndex()
    {
        if (Auth::user()->type_id == 1) {
            $equipment = $this->equipment->all();            
        } else {
            $equipment = $this->equipment->all()->where('user_id', Auth::user()->id);
        }

        return view('equipment.index')->with(compact('equipment'));
    }

    public function showCreate()
    {
        $user = $this->user->all()->where('id', '!=', 1)->where('id', '!=', Auth::user()->id);
        $manufacturer = $this->manufacturer->all();
        $typeEquipment = $this->typeEquipment->all();
        
        return view('equipment.create')->with(compact('user'))->with(compact('manufacturer'))->with(compact('typeEquipment'));        
    }

    public function saveCreate(EquipmentRequest $request)
    {            
        $data = [            
            'name' => upperStart($request->name),
            'network_name' => upperAll($request->network_name),
            'tag_name' => upperAll($request->tag_name),
            'ip' => upperAll($request->ip),
            'manufacturer_id' => $request->manufacturer_id,
            'type_id' => $request->type_id,
            'model' => upperStart($request->model),
            'serial_number' => upperAll($request->serial_number),
            'note' => upperFirst($request->note)
        ];
        
        if (Auth::user()->type_id == 1) {            
            $data['user_id'] = $request->user_id;
        } else {
            $data['user_id'] = Auth::user()->id;
        }

        $equipment = $this->equipment->create($data);

        $notification = array(
            'message' => 'Equipamento cadastrado com sucesso',
            'alert-type' => 'success'
        );

        return redirect()->route('equipmentIndex')->with($notification);
    }

    public function showEdit($id)
    {        
        $user = $this->user->all()->where('id', '!=', 1)->where('id', '!=', Auth::user()->id);
        $manufacturer = $this->manufacturer->all();
        $typeEquipment = $this->typeEquipment->all();
     
        $equipment = $this->equipment->findOrFail($id);

        if (Auth::user()->type_id == 2 && $equipment->user_id != Auth::user()->id) {
            abort(404);
        }

        return view('equipment.edit')->with(compact('user'))->with(compact('manufacturer'))->with(compact('typeEquipment'))->with(compact('equipment'));        
    }

    public function saveEdit(EquipmentRequest $request)
    {    
        $equipment = $this->equipment->findOrFail($request->id);        
        
        $data = [                
            'name' => upperStart($request->name),
            'network_name' => upperAll($request->network_name),
            'tag_name' => upperAll($request->tag_name),
            'ip' => upperAll($request->ip),
            'manufacturer_id' => $request->manufacturer_id,
            'type_id' => $request->type_id,
            'model' => upperStart($request->model),
            'serial_number' => upperAll($request->serial_number),
            'note' => upperFirst($request->note)
        ];

        if (Auth::user()->type_id == 1) {
            $data['user_id'] = $request->user_id;
        }

        $equipment->update($data);
        $equipment->save();

        $notification = array(
            'message' => 'Equipamento alterado com sucesso',
            'alert-type' => 'success'
        );

        return redirect()->route('equipmentIndex')->with($notification);
    }    

    public function saveDelete($id)
    {        
        $equipment = $this->equipment->findOrFail($id);

        if (Auth::user()->type_id == 2 && $equipment->user_id != Auth::user()->id) {
            abort(404);
        }
        
        DB::table('ticket')->where('equipment_id', $equipment->id)->update(['equipment_id' => null]);
        
        $equipment->delete();

        $notification = array(
            'message' => 'Equipamento apagado com sucesso',
            'alert-type' => 'success'
        );

        return redirect()->route('equipmentIndex')->with($notification);        
    }

}
