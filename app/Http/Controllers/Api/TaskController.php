<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskResourceCollection;
use App\Models\Task;
use App\Repository\TaskRepository;
use App\Services\ApiResponseBuilder;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(public TaskRepository $repository){}

    public function index()
    {
        $tasks=$this->repository->all();
        return (new ApiResponseBuilder())->data(new TaskResourceCollection($tasks))->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task=$this->repository->add($request->validated());
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
        $newTask=$this->repository->find($task);
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
        $status=$this->repository->update($task,$request->validated());
        $actionResult=$status?
            (new ApiResponseBuilder())->message('task updated successfully'):
            (new ApiResponseBuilder())->message('task cannot be updated');
        return $actionResult->data(new TaskResource($task))->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $status=$this->repository->delete($task);
        $actionResult=$status?
            (new ApiResponseBuilder())->message('task deleted successfully'):
            (new ApiResponseBuilder())->message('task cannot be deleted');
        return $actionResult->response();
    }
}
