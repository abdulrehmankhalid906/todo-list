<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function myprofile()
    {
        $users = Task::where('assigned_to', Auth::user()->id)->get();
        
        return view('profile.myprofile',[
            'tasks' => $users,
        ]);
    }
}
