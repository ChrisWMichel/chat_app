<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userList(){
        $users = User::all();

        return response($users->jsonSerialize());
    }


}
