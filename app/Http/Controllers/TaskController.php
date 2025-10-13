<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $admin=Auth::guard('admin')->user();

/*        $admin=Auth::user();
        $tasks=$admin->adminTasks()->paginate(2);*/

        $adminId = Auth::id();
        /*$tasks=Task::where('admin_id', $adminId)->where('is_active',1)->paginate(2);*/
        $tasks=Task::where('admin_id', $adminId)->paginate(2);

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
        $admin_id=Auth::id();
        $task=Task::create([
            ...$request->validated(),
            'admin_id'=>$admin_id,
        ]);
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
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $status=$task->update($request->validated());
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
        $task->update(['is_active'=>0]);
        return redirect()->route('tasks.index');
    }
}
