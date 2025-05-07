<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Report;
use App\Models\Adoption;
use App\Models\Follower;
use Illuminate\Http\Request;
use App\Http\Requests\EditProfileInfo;
use App\Services\users\ProfileService;
use App\Http\Requests\EditImageprofile;

class UserProfileController extends Controller
{
    //

    protected $profileService;
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }


    public function index(){
        $user = auth()->user();
        $userinfo = User::where('id', $user->id)->first();

        $reportsCount = Report::where('reporter_id', $user->id)->count();
        $reportsUser = Report::where('reporter_id', $user->id)->get();
        $adoptionCount = Adoption::where('adopterId', $user->id)->where('status', 'accepted')->count();
        $adoptions = Adoption::with('animal')
        ->where('adopterId', $user->id)
        ->where('status', 'approved') 
        ->get();

        // dd($reportsCount);
        $followersCount = 0;
        return view('user.profile.profile' , compact('userinfo' , 'reportsCount', 'adoptionCount' , 'followersCount' , 'reportsUser' , 'adoptions'));
    }


    public function editProfileInfo(EditProfileInfo $request){

        $credentials = $request->validated();
        $user = $this->profileService->updateProfileInfo($credentials);
        return redirect()->route('user.Profile')->with('success', 'Profile updated successfully');   
    }


    // public function editProfileInfo(EditProfileInfo $request){

    //     $credentials = $request->validated();
    //     $user = $this->profileService->updateProfileInfo($credentials);
    //     return redirect()->route('user.Profile')->with('success', 'Profile updated successfully');
    // }

}
