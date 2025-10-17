<?php

namespace App\Services;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    public function getTasks()
    {
        $admin = Auth::user();
        $tasks=$admin->adminTasks();
        return $tasks;
    }

    public function addTask($request)
    {
        $admin_id=Auth::id();
        $task=Task::create([
            ...$request->validated(),
            'admin_id'=>$admin_id,
        ]);
        return $task;
    }

    public function showTask($task)
    {
        return $task;
    }
    public function updateTask($request, $task)
    {
        $status=$task->update($request->validated());
        return $status;
    }
    public function deleteTask($task){
        $status=$task->update(['is_active'=>0]);
        return $status;
    }
}
