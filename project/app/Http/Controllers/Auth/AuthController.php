<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Services\Auth\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        
        if($authOrFaile == null)
        {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
        {

        }

        if($authOrFaile)
        {
            if ($authOrFaile->status == 'inactive') {
                return redirect()->back()->with('error', 'Your account is inactive. Please contact support.');
            }
            if ($authOrFaile->role_id == 1) {
                return redirect()->route('admin.HomeAdmin')->with('success', 'Login successful');
            }
            if ($authOrFaile->role_id == 2) {
                return redirect()->route('user.HomeUser')->with('success', 'Login successful');
            }
            if ($authOrFaile->role_id == 3) {
                return redirect()->route('shelter.HomeShelter')->with('success', 'Login successful');
            }
        }
        

    }

    public function logout(Request $request)
    {
      
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

       
  
            return redirect()->route('Auth')->with('success', 'Logout successful');
        

    }
}
