<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskResourceCollection;
use App\Models\Task;
use App\Services\UserTaskService;
use Illuminate\Http\Request;

class UserTaskController extends Controller
{
    public function __construct(public UserTaskService $service){}

    public function getUserTasks()
    {
        $tasks = $this->service->getTasks();
        return response()->json(new TaskResourceCollection($tasks),200);
    }

    public function changeTaskStatus(Task $task)
    {
        $this->service->changeStatus($task);
        return response()->json(new TaskResource($task),200);
    }
}
