<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEditRequest;
use App\Profile;
use App\TypeUser;
use App\User;
use App\Gender;
use App\Marital;
use App\State;
use App\City;

class UserController extends Controller
{

    protected $user;
    protected $typeUser;
    protected $profile;

    public function __construct(User $user, TypeUser $typeUser, Gender $gender, State $state, Profile $profile, Marital $marital, City $city)
    {        
        $this->user = $user;
        $this->typeUser = $typeUser;
        $this->profile = $profile;
        $this->gender = $gender;
        $this->state = $state;
        $this->marital = $marital;
        $this->city = $city;
    }

    public function showIndex()
    {
        if(Auth::user()->type_id == 1){
            $user = $this->user->all()->where('id', '!=', 1)->where('id', '!=', Auth::user()->id);
            return view('user.index')->with(compact('user'));   
        } else {
            abort(401);
        }        
    }
    
    public function showCreate()
    {
        if(Auth::user()->type_id == 1){
            $typeUser = $this->typeUser->all();
            return view('user.create')->with(compact('typeUser'));
        } else {
            abort(401);
        }        
    }

    public function saveCreate(UserRequest $request)
    {                
        if(Auth::user()->type_id == 1){
            $dataUser = [
                'name' => upperStart($request->name),
                'email' => lowerAll($request->email),
                'password' => Hash::make($request->password),
                'type_id' => $request->type_id
            ];
            
            $user = $this->user->create($dataUser);
            
            $data['user_id'] = $user->id;
            $profile = $this->profile->create($data);
                 
            $notification = array(
                'message' => 'Usuário cadastrado com sucesso',
                'alert-type' => 'success'              
            );            
        
            return redirect()->route('userIndex')->with($notification); 
        } else {
            abort(401);
        }        
    }    

    public function saveDelete($id)
    {
        if(Auth::user()->type_id == 1){
            $user = $this->user->findOrFail($id);
            $user->delete();

            $notification = array(
                'message' => 'Usuário apagado com sucesso',
                'alert-type' => 'success'              
            );
                            
            return redirect()->route('userIndex')->with($notification);            
        } else {
            abort(401);
        }        
    }

    public function showEdit($id)
    {
        if(Auth::user()->type_id == 1){
            $user = $this->user->findOrFail($id);
            $typeUser = $this->typeUser->all();
            $gender = $this->gender->all();
            $state = $this->state->all();
            $marital = $this->marital->all();
            $city = $this->city->all()->where('state_id', $user->getProfile->getStateIdFormatted());

            return view('user.edit')->with(compact('user'))->with(compact('typeUser'))->with(compact('gender'))->with(compact('state'))->with(compact('city'))->with(compact('marital'));
        } else {
            abort(401);
        } 
    }

    public function saveEdit(UserEditRequest $request)
    {        
        if(Auth::user()->type_id == 1){
            $user = $this->user->findOrFail($request->id);
            
            $data = [
                'name' => upperStart($request->name),
                'email' => lowerAll($request->email),
                'type_id' => $request->type_id
            ];

            if($request->password != null)
            {
                $data['password'] = Hash::make($request->password);
            }                

            $user->update($data);
            $user->save();

            $profile = $this->profile->findOrFail($request->id);
        
            $data = [
                'cpf' => $request->cpf,
                'gender_id' => $request->gender_id,
                'marital_id' => $request->marital_id,
                'zipcode' => $request->zipcode,
                'city_id' => $request->city_id,
                'neighborhood' => upperStart($request->neighborhood),
                'street' => upperStart($request->street),
                'number' => $request->number,
                'complement' => upperFirst($request->complement),
                'telephone' => $request->telephone,
                'cellphone' => $request->cellphone,
                'whatsapp' => $request->whatsapp
            ];

            $profile->update($data);
            $profile->save();

            if($request->hasFile('file')){
                if($profile->path != null){
                    Storage::delete($profile->path);
                }

                $profile->path = $request->file->store('public/profile');
                $profile->file = $request->file->hashName();
                $profile->save();
            }

            $notification = array(
                'message' => 'Usuário alterado com sucesso',
                'alert-type' => 'success'
            );
            
            return redirect()->route('userIndex')->with($notification);
        } else {
            abort(401);
        } 
    }

    public function getCity($id, $state_id)
    {
        $city = $this->city->all()->where('state_id', $state_id);

        return response()->json($city, 200);
    }

}
