<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Services\Auth\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    //
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    
        
    public function index()
    {
        
        return view('auth.auth');
    }
    
    public function register(AuthRequest $request)
    {
        
        $credentials = $request->only(['name', 'email', 'role_id' , 'password']);

        // dd($credentials);

        $authOrFaile = $this->authService->register($credentials);
        if($authOrFaile)
        {
            return redirect()->route('Auth')->with('success', 'User registered successfully');
        }
    }


    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        $authOrFaile = $this->authService->login($credentials);

        if($authOrFaile)
        {
            return redirect()->route('user.HomeUser')->with('success', 'Login successful');
        }

    }

    public function logout(Request $request)
    {
        $authOrFaile = $this->authService->logout();

    }
}
