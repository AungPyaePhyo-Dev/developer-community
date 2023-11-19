<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() 
    {
        $users = User::get();

        return $users;
    }


    public function store(StoreUserRequest $request)
    {
      $user =  User::create($request->all());

      $token = $user->createToken('User Create Token')->accessToken;

      $data = [
        'status' => true,
        'message' => 'User successfully created',
        'token' => $token
      ];

      return $data;
    }


    public function redirect()
    {
        return response()->json([
            'message' => "You are not authenticated user"
        ]);
    }
}
