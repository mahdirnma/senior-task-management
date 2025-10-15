<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResourceCollection;
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
}
