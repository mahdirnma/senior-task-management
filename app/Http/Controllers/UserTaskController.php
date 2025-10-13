<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTaskController extends Controller
{
    public function index(){
        $user=Auth::user();
        $tasks=$user->tasks()->paginate(2);
        return view('user.index',compact('tasks'));
    }

    public function taskStatus(Task $task)
    {
        $status=$task->update(['status'=>1]);
        return redirect()->route('user.tasks');
    }

}
