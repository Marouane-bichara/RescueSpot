<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\shelter\ShelterProfileServices;

class EditeProfileInfoSController extends Controller
{
    //

    protected $shelterProfileServices;

    public function __construct(ShelterProfileServices $shelterProfileServices)
    {
        $this->shelterProfileServices = $shelterProfileServices;
    }
    public function editeProfileInfoS(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'profilePhoto' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        'backgroundProfile' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:100',
        'country' => 'nullable|string|max:100',
        'bio' => 'nullable|string',
        'website' => 'nullable|string|max:255',
        'founded' => 'nullable|integer',
        'weekday_hours' => 'nullable|string|max:100',
        'saturday_hours' => 'nullable|string|max:100',
        'sunday_hours' => 'nullable|string|max:100',
        'holiday_hours' => 'nullable|string|max:100',
    ]);

    $this->shelterProfileServices->editShelterProfileI($request, $validatedData);

    return redirect()->back()->with('success', 'Profile updated successfully!');
}

}
