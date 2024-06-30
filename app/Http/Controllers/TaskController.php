<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function Homepage()
    {
        $tasks = Task::with('assignedTo')->paginate(6);
        // dd($tasks);
        return view('welcome', compact('tasks'));
    }

    public function index()
    {
        $users = User::all();
        $tasks = Task::with(['users','assignedTo'])->where('user_id', Auth::user()->id)->get();

        // dd($tasks);

        return view('tasks.create-task',[
            'tasks' => $tasks,
            'users' => $users,
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'days' => 'required',
            'assigned_to' => 'required'
        ]);

        Task::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'days' => $request->days,
            'is_completed' => 0,
            'assigned_to' => $request->assigned_to,
        ]);

        return redirect()->back()->with('success', 'Your task has been added!');
    }

    public function show($id)
    {
        $users = User::all();
        $task = Task::where('user_id', Auth::user()->id)->findorFail($id);
        return view('tasks.edit',[
            'task' => $task,
            'users' => $users,
        ]);
    }

    public function updatePost(Request $request , $id)
    {
        // $user = User::all();
        $task = Task::findorFail($id);

        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            // 'days' => $request->input('days'),
            'is_completed' => $request->input('is_completed'),
            'assigned_to' => $request->input('assigned_to'),
        ]);

        return redirect('create-task')->with('success','Post Updated Successfully!');
    }

    public function searchTasks(Request $request)
    {
        $task = Task::with('assignedTo')->where('title', 'LIKE', '%'.$request->searching.'%')
        ->orWhere('description', 'LIKE', '%'.$request->searching.'%')->get();

        return response()->json([
            'task' => $task,
        ]);
    }

}
