<?php

namespace App\Services;

use App\Models\User;

class UserService 
{
    public static function registerUser($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
        error_log($user);
        $user->save();
        return $user;
    }

}