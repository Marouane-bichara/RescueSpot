<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Reports;
use App\Models\Adoptions;
use App\Models\Followers;
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


        $reportsCount = Reports::where('reporter_id', $user->id)->count();
        $reportsUser = Reports::where('reporter_id', $user->id)->get();
        $adoptionCount = Adoptions::where('adopterId', $user->id)->count();
        $followersCount = Followers::where('followed_id', $user->id)->count();
        $adoptionUser = Adoptions::where('adopterId', $user->id)->get();

        // dd($reportsCount);
        return view('user.profile.profile' , compact('userinfo' , 'reportsCount', 'adoptionCount' , 'followersCount' , 'reportsUser' , 'adoptionUser'));
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
