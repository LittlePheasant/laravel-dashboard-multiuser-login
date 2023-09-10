<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UsersController extends Controller
{
    function __construct() {
        $this->user = new User;
    }

    public function getPaginatedUsers(Request $request) {
        $users = $this->user->getUserLists(); 
        
        return view('partials.users.show' , compact('users'));

    }

    public function userInfoByID($id) {
        $users = $this->user->getuserInfoByID($id);

        return view('partials.users.show' , compact('users'));

    }

    
}
