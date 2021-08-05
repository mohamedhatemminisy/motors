<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = $this;
        // make token
        $client = \Laravel\Passport\Client::where('password_client', 1)->first();

        $request->request->add([
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $this->email,
            'password' => $this->password,
            'scope' => null,
        ]);

        // Fire off the internal request.
        $proxy = Request::create(
            'oauth/token',
            'POST'
        );

        $token = $user->createToken('MyApp')->accessToken;
dd($token);
        return [
            'message' => 'تم تسجيل الدخول بنجاح',
            'user_id'=>$this->id,
            'name'=>$this->clients->fullname,
            'image'=>($this->image!='')?url($this->image):'',
            'token'=>$token,
            'type' => $this->clients->type,
            'fullname' => $this->clients->fullname,
            'birthdate' => $this->clients->birthdate,
            'gender' => $this->clients->gender,
            'location' => $this->clients->location,
            'country_code' => $this->clients->country_code,
            'user_language' => $this->clients->user_language,
            'lat' => $this->clients->lat,
            'long' => $this->clients->long,
            'verified' => $this->clients->verified,
        ];



    }
}
