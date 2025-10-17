<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskResourceCollection;
use App\Models\Task;
use App\Services\ApiResponseBuilder;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(public TaskService $service){}

    public function index()
    {
        $tasks=$this->service->getTasks();
        return (new ApiResponseBuilder())->data(new TaskResourceCollection($tasks))->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task=$this->service->addTask($request);
        $actionResult=$task?
            (new ApiResponseBuilder())->message('task created successfully'):
            (new ApiResponseBuilder())->message('task cannot be created');
        return $actionResult->data(new TaskResource($task))->response();
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $newTask=$this->service->showTask($task);
        $actionResult=$task?
            (new ApiResponseBuilder())->message('task showed successfully'):
            (new ApiResponseBuilder())->message('task cannot be found');
        return $actionResult->data(new TaskResource($task))->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $status=$this->service->updateTask($request,$task);
        if($status){
            return response()->json(new TaskResource($task),200);
        }
        return response()->json(['error'=>'Task not updated'],500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->service->deleteTask($task);
        return response()->json('task deleted successfully',204);
    }
}
