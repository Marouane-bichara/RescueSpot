<?php
namespace App\Services\Auth;

use App\Repository\AuthRepository\AuthRepository;

class AuthService
{

    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
         $this->authRepository = $authRepository;
    }
 
 
    public function register($credentials)
    {
        $authOrFaile =  $this->authRepository->register($credentials);

        return $authOrFaile;
    }
    
    public function login($credentials)
    {
        $authOrFaile = $this->authRepository->login($credentials);
        return $authOrFaile;
    }

    public function logout()
    {
        $authOrFaile = $this->authRepository->logout();
        return $authOrFaile;
    }
}