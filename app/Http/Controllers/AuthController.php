<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /*Not being used, but it works*/

    public function login(Request $request) {
        //$request->password = bcrypt($request->password);
        //$this->validateLogin($request);

        //$user = User::where('email', $request->input('email'))->first();
        $hashedPassword = User::where('email', $request->email)->first();

            if($hashedPassword && Hash::check($request->password, $hashedPassword->password)){
                return response('true');
            }else{
                return response('false');
            }

    }

    protected function validateLogin(Request $request)
    {

        $this->validate($request, [
          'email' => 'required|string',
          'password' => 'required|string',
        ]);
    }


    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
          $this->credentials($request), $request->filled('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only('email', 'password');
    }

    protected function guard()
    {
        return Auth::guard();
    }

    public function logout(){
        Auth::logout();
    }
}
