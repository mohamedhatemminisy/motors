<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\Api\StatusCollection;
use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{
    public function register(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'company_name' => $request->company_name,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'phone'   => $request->phone,
            'termes'  => $request->termes,
            'VAT'     => $request->VAT,
            'NIP'     => $request->NIP,
            'IBAN'     => $request->IBAN,
            'device_token' => $request->device_token,
            'password' => bcrypt($request->password)
        ]);
       
        $token = $user->createToken('LaravelAuthApp')->accessToken;
        $data['id'] = $user->id;
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $data['first_name'] = $user->first_name;
        $data['company_name'] = $user->company_name;
        $data['address'] = $user->address;
        $data['city'] = $user->city;
        $data['country'] = $user->country;
        $data['phone'] = $user->phone;
        $data['termes'] = $user->termes;
        $data['VAT'] = $user->VAT;
        $data['NIP'] = $user->NIP;
        $data['IBAN'] = $user->IBAN;
        $data['password'] = $user->password;
        $data['device_token'] = $user->device_token;
        $data['verified'] = $user->email_verified_at ? '1' : "0";
        $data['token'] = $token;

        return response([
            'status' =>true ,
            'message' =>trans('success.registered')  ,
            'data' =>$data
        ]); 
        }
 
     /**
     * Login
     */
    public function login(Request $request)
    {
        $user = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (auth()->attempt($user)) {
            $user =User::where('email',$user['email'])->first();

            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            $data['id'] = $user->id;
            $data['email'] = $user->email;
            $data['name'] = $user->name;
            $data['first_name'] = $user->first_name;
            $data['company_name'] = $user->company_name;
            $data['address'] = $user->address;
            $data['city'] = $user->city;
            $data['country'] = $user->country;
            $data['phone'] = $user->phone;
            $data['termes'] = $user->termes;
            $data['VAT'] = $user->VAT;
            $data['NIP'] = $user->NIP;
            $data['IBAN'] = $user->IBAN;
            $data['password'] = $user->password;
            $data['device_token'] = $user->device_token;
            $data['verified'] = $user->email_verified_at ? '1' : "0";
            $data['token'] = $token;

            return response([
                'status' =>true ,
                'message' =>trans('success.logined')  ,
                'data' =>$data
            ]); 
        } else {
            return response()->json(['status' =>false ,'error' => 'success.data_not_mach','data' =>[]], 401);
        }
    }
    
    public function getProfileData(Request $request)
    {
        $user = auth()->user();
        if ($user){
            $data['id'] = $user->id;
            $data['email'] = $user->email;
            $data['name'] = $user->name;
            $data['first_name'] = $user->first_name;
            $data['company_name'] = $user->company_name;
            $data['address'] = $user->address;
            $data['city'] = $user->city;
            $data['country'] = $user->country;
            $data['phone'] = $user->phone;
            $data['termes'] = $user->termes;
            $data['VAT'] = $user->VAT;
            $data['NIP'] = $user->NIP;
            $data['IBAN'] = $user->IBAN;
            $data['password'] = $user->password;
            $data['verified'] = $user->email_verified_at ? '1' : "0";
            $data['device_token'] = $user->device_token;
            $data['token'] = '';
            return response([
                'status' =>true ,
                'message' =>trans('success.user_profile')  ,
                'data' =>$data
            ]); 
         }
        else{
               return (new StatusCollection(false, 'برجاء التاكد من المستخدم.'))->response()->setStatusCode(401);
        }
    }


    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $user->update([
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'phone'   => $request->phone,
            'VAT'     => $request->VAT,
            'NIP'     => $request->NIP,
            'IBAN'     => $request->IBAN,
            'device_token' => $request->device_token
        ]);
            $data['id'] = $user->id;
            $data['email'] = $user->email;
            $data['name'] = $user->name;
            $data['first_name'] = $user->first_name;
            $data['company_name'] = $user->company_name;
            $data['address'] = $user->address;
            $data['city'] = $user->city;
            $data['country'] = $user->country;
            $data['phone'] = $user->phone;
            $data['termes'] = $user->termes;
            $data['VAT'] = $user->VAT;
            $data['NIP'] = $user->NIP;
            $data['IBAN'] = $user->IBAN;
            $data['password'] = $user->password;
            $data['verified'] = $user->email_verified_at ? '1' : "0";
            $data['token'] = '';
        return response([
            'status' =>true ,
            'message' =>trans('success.user_updated')  ,
            'data' =>$data
        ]);    
    }
}
