<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users= User::all();
        $user = User::count();
        $task = Task::count();
        $pendingtask = Task::where('is_completed', '0')->count();
        $completedtask = Task::where('is_completed', '1')->count();
        return view('home', compact('user','task','pendingtask','completedtask','users'));
    }

    public function viewTasks()
    {
        $tasks = Task::with('users')->get();
        return view('extras.tasks', compact('tasks'));
    }

    public function viewUsers(Request $request)
    {
        $users = User::with('tasks')->get();
        return view('extras.users', compact('users'));
    }


    public function destroy($id)
    {
        $task = Task::with('users')->findorFail($id);
        $task->delete();

        return redirect()->back()->with('success','The task has been deleted!');
    }

    public function destroyUser($id)
    {
        $user = User::with('tasks')->findorFail($id);

        foreach($user->tasks as $tasksdeletes)
        {
            $tasksdeletes->delete();
        }

        $user->delete();

        return redirect()->back()->with('success','The user has been deleted!');

    }

    public function updateUserData($id, Request $request)
    {
        $user = User::findorFail($id);

        $user->update([
            'email' => $request->input('email'),
            'name' => $request->input('name'),
        ]);

        return redirect()->back()->with('success','The user data is updated!');
    }

}
