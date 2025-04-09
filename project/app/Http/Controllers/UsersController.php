<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Animals;
use App\Models\Reports;
use App\Models\Messages;
use App\Models\Adoptions;
use App\Models\Followers;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //

    public function indexHome()
    {
        $reports = Reports::latest()->paginate(6);  // Paginate reports, 10 per page
        $readyAnimals = Animals::where('status', 'ready')->paginate(6);

        $user = auth()->user();

        $reportsUser = Reports::where('reporter_id', $user->id)->get();


        $conversations = Messages::where('sender_id', $user->id)
        ->orWhere('receiver_id', $user->id)
        ->latest()  // Get the latest message first
        ->get()
        ->groupBy(function ($message) use ($user) {
            return $message->sender_id == $user->id ? $message->receiver_id : $message->sender_id;
        })
        ->map(function ($messages) {
            $lastMessage = $messages->first(); 
            $otherUser = $lastMessage->sender_id == auth()->id() ? $lastMessage->receiver : $lastMessage->sender;

            return [
                'user_id' => $otherUser->id,
                'photo' => $otherUser->profilePhoto,
                'last_message' => $lastMessage->message,
            ];
        });
            

        return view('user.home', compact('reports', 'readyAnimals' , 'reportsUser' , 'conversations'));
    }


    public function indexProfile()
    {

        $user = auth()->user();
        $userinfo = User::where('id', $user->id)->first();

        $reportsCount = Reports::where('reporter_id', $user->id)->count();
        $adoptionCount = Adoptions::where('adopterId', $user->id)->count();
        $followersCount = Followers::where('followed_id', $user->id)->count();

        return view('user.profile.profile' , compact('userinfo' , 'reportsCount', 'adoptionCount' , 'followersCount'));
    }


    public function indexProfileEdit()
    {


    }
}
