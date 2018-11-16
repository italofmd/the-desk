<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileEditRequest;
use App\Http\Requests\ProfilePasswordRequest;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Profile;
use App\TypeUser;
use App\Gender;
use App\Marital;
use App\State;
use App\City;

class ProfileController extends Controller
{

    protected $user;
    protected $typeUser;
    protected $gender;
    protected $marital;
    protected $state;
    protected $profile;
    protected $city;

    public function __construct(User $user, TypeUser $typeUser, Gender $gender, State $state, Profile $profile, Marital $marital, City $city)
    {        
        $this->user = $user;
        $this->typeUser = $typeUser;
        $this->gender = $gender;
        $this->marital = $marital;
        $this->state = $state;
        $this->profile = $profile;
        $this->city = $city;
    }    

    public function getCity($id)
    {
        $city = $this->city->all()->where('state_id', $id);

        return response()->json($city, 200);
    }
    
    public function showEdit()
    {
        $gender = $this->gender->all();
        $state = $this->state->all();
        $marital = $this->marital->all();
        $city = $this->city->all()->where('state_id', Auth::user()->getProfile->getStateIdFormatted());

        return view('profile.edit')->with(compact('gender'))->with(compact('state'))->with(compact('city'))->with(compact('marital'));
    }

    public function saveEdit(ProfileEditRequest $request)
    {
        $user = $this->user->findOrFail(Auth::user()->id);
        
        $data = [
            'name' => upperStart($request->name),
            'email' => lowerAll($request->email)
        ];                        

        $user->update($data);
        $user->save();
                    
        $profile = $this->profile->findOrFail(Auth::user()->id);
        
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
            'message' => 'Perfil alterado com sucesso',
            'alert-type' => 'success'
        );        

        return redirect()->route('profileEdit')->with($notification);
    }

    public function showPassword()
    {                
        return view('profile.password');
    }

    public function savePassword(ProfilePasswordRequest $request)
    {
        $user = $this->user->findOrFail(Auth::user()->id);
        $data['password'] = Hash::make($request->password);
        $user->update($data);
        $user->save();
        
        $notification = array(
            'message' => 'Senha alterada com sucesso',
            'alert-type' => 'success'
        );        

        return redirect()->route('profilePassword')->with($notification);        
    }

}
