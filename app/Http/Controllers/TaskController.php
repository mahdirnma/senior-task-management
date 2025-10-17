<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\User;
use App\Repository\TaskRepository;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//    public function __construct(public TaskService $service){}
    public function __construct(public TaskRepository $repository){}

    public function index()
    {
//        $admin=Auth::guard('admin')->user();

        $tasks=$this->repository->all();
        return view('admin.tasks.index',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users=User::where('role','user')->where('is_active',1)->get();
        return view('admin.tasks.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task=$this->repository->add($request->validated());
        if($task){
            return redirect()->route('tasks.index');
        }
        return redirect()->route('tasks.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $users=User::where('role','user')->where('is_active',1)->get();
        return view('admin.tasks.edit',compact('task','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Task $task,UpdateTaskRequest $request)
    {
        $status=$this->repository->update($task,$request->validated());
        if($status){
            return redirect()->route('tasks.index');
        }
        return redirect()->route('tasks.edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->repository->delete($task);
        return redirect()->route('tasks.index');
    }
}
