<?php
namespace App\Repository\AuthRepository;

use App\Models\User;
use App\Models\Shelter;
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

        if($user->role_id == 3)
        {
            $shelter = Shelter::create([
                'user_id' => $user->id,
                'shelterName' => $user->name,
                'address' => 'empty',
                'city' => 'empty',
                'state' => 'empty',
                'zip_code' => 'empty',
                'country' => 'empty',
                'description' => 'empty',
                'website' => 'empty',
            ]);
            
        }



            return [
                'user' => $user,
                'shelter' => isset($shelter) ? $shelter : null,
            ];
        
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