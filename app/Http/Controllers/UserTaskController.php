<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\UserTaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTaskController extends Controller
{
    public function __construct(public UserTaskService $service){}

    public function index(){
        $tasks=$this->service->getTasks();
        return view('user.index',compact('tasks'));
    }

    public function taskStatus(Task $task)
    {
        $this->service->changeStatus($task);
        return redirect()->route('user.tasks');
    }

}
