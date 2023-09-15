<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    public function add_user(Request $request) {

        Validator::make($request->all(), [
            'campusname' => ['required'],
            'name' => ['required'],
            'username' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed'],
            'avatar' => ['required'],
            'role' => ['required']
        ]);

        $userData =[
            'campusname' => $request->campusname,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $request->avatar,
            'role' => (int)$request->role,
        ];

        User::create($userData);

        return redirect()->route('users-lists');
    }

    
}
