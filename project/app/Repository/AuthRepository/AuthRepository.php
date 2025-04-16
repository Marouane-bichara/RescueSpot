<?php
namespace App\Repository\AuthRepository;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

    

class AuthRepository{


    
    public function register($credentials)
    {

        // $imagePath = isset($credentials['profilePhoto']) ? $credentials['profilePhoto']->store('profile-photos', 'public') : null;
        // $credentials['profilePhoto'] = $imagePath;
        $status = 'active';
        if($credentials['role_id'] == 3)
        {
            $status = 'inactive';
        }
        if($credentials['role_id'] == 2){
            $status = 'active';
        }

        if($credentials['role_id'] == 1)
        {
            return   redirect()->route('Auth')->with('Error', 'You can`t pick admin role');
        }

        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
            'status' => $status,
            'role_id' => $credentials['role_id'],

        ]);

            return $user;
        
    }
    
    public function login($credentials)
    {

        if (auth()->attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            $user = auth()->user();
            
            return $user;
        }else{
            return null;
        }
    
        return redirect()->back()->with('error', 'Invalid credentials');
    }





}

?>