<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function myprofile()
    {
        $userAuth = Auth::user();
        $users = Task::whereHas('users', function ($query) use ($userAuth) {
            $query->where('id', $userAuth->id);
        })->get();

        //other way
        // $tasks = $user->tasks;


        return view('profile.myprofile',[
            'tasks' => $users,
        ]);
    }
}
