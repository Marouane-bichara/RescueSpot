<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Animal;
use App\Models\Report;
use App\Models\Message;
use App\Models\Adoption;
use App\Models\Follower;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //

    public function indexHome()
    {
        $reports = Report::latest()->paginate(6);  // Paginate reports, 10 per page
        $readyAnimals = Animal::where('status', 'ready')->paginate(6);

        $user = auth()->user();

        $reportsUser = Report::where('reporter_id', $user->id)->get();
        $userinfo = User::where('id', $user->id)->first();


        $conversations = Message::where('sender_id', $user->id)
        ->orWhere('receiver_id', $user->id)
        ->latest()
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
            

        return view('user.home', compact('reports', 'readyAnimals' , 'reportsUser' , 'conversations' , 'userinfo'));
    }




}
