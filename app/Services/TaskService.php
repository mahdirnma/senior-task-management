<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    public function getTasks()
    {
        $adminId = Auth::id();
        $tasks=Task::where('admin_id', $adminId)->paginate(2);
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

    public function updateTask($request, $task)
    {
        $status=$task->update($request->validated());
        return $status;
    }
    public function deleteTask($task){
        $task->update(['is_active'=>0]);
    }
}
