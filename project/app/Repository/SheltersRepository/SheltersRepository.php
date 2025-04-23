<?php 

namespace App\Repository\SheltersRepository;

use App\Models\Animal;
use App\Models\Report;
use App\Models\Message;
use App\Models\Shelter;
use App\Models\Adoption;

class  SheltersRepository{


        public function getAllAnimals()
        {
            return Animal::where('status', 'ready for adoption')->get();
        }

        public function getallTheAdoptionRequests()
        {

            $userId = auth()->user()->id; 
            $shelter = Shelter::where('user_id', $userId)->first(); 

            $adoptionRequests = Adoption::where('status', 'pending')->whereHas('animal', function ($query) use ($shelter) {
                    $query->where('shelter_id', $shelter->id);
                })
                ->with(['animal', 'adopter']) 
                ->get();

                // dd($adoptionRequests);

                return $adoptionRequests;
                
        }

        public function getallAdoptionsReqPaginations()
        {

            $userId = auth()->user()->id; 
            $shelter = Shelter::where('user_id', $userId)->first(); 


            $adoptionRequests = Adoption::where('status', 'pending')
            ->whereHas('animal', function ($query) use ($shelter) {
                $query->where('shelter_id', $shelter->id);
            })
            ->with(['animal', 'adopter'])
            ->paginate(10); 
        

                


                return $adoptionRequests;
        }

        public function getLatestReports()
        {
            $reports = Report::latest()->paginate(3); 
            return $reports;
        }

        public function sheltAnimalsForAdoption()
        {
            $userId = auth()->user()->id; 
            $shelter = Shelter::where('user_id', $userId)->first(); 

            $animals = Animal::where('shelter_id', $shelter->id)->paginate(6); 

            return $animals;
        }


        public function addAnimal($credentials)
        {
            $userId = auth()->user()->id;
            $shelter = Shelter::where('user_id', $userId)->first();
            $shelterId = $shelter->id;
        
            // Handle image upload
            if (isset($credentials['photoAnimal']) && $credentials['photoAnimal']->isValid()) {
                $path = $credentials['photoAnimal']->store('animals', 'public'); // stores in storage/app/public/animals
            } else {
                $path = null; // Or set a default image path if needed
            }
        
            $animal = Animal::create([
                'name' => $credentials['name'],
                'photoAnimal' => $path, // store the relative path
                'species' => $credentials['species'],
                'breed' => $credentials['breed'],
                'age' => $credentials['age'],
                'status' => $credentials['status'],
                'shelter_id' => $shelterId,
            ]);
        }

public function getMessages()
{
    $user = auth()->user(); 
    return Message::where('sender_id', $user->id)
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
                'username' => $otherUser->name,
                'photo' => $otherUser->profilePhoto,
                'last_message' => $lastMessage->message,
            ];
        })->values();
}

public function rejectAdoptionRequest($id)
{
    $adoptionRequest = Adoption::find($id);
    if ($adoptionRequest) {
        $adoptionRequest->status = 'rejected';
        $adoptionRequest->save();
        return $adoptionRequest;
    }
    return null; // or handle the case where the request is not found
}
public function aproveAdoptionRequest($id)
{
    $adoptionRequest = Adoption::find($id);

    if ($adoptionRequest) {
        $adoptionRequest->status = 'approved';
        $adoptionRequest->save();
        $animal = Animal::find($adoptionRequest->animalId);

        if ($animal) {
            $animal->delete();
        }
        return $adoptionRequest;
    }
   
    return null; 
    
}
}