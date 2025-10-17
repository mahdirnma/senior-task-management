<?php

namespace App\Repository;

use App\Models\Task;
use App\Repository\Contracts\TaskRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Collection;

class TaskRepository implements TaskRepositoryInterface
{
    public function __construct(protected Task $task){}

    public function all()
    {
        $admin=Auth::user();
        $tasks=$admin->adminTasks();
        return $tasks;
    }

    public function add(array $data): Task
    {
        $admin_id=Auth::id();
        $task=$this->task->create([
            ...$data,
            'admin_id'=>$admin_id,
        ]);
        return $task;
    }

    public function update($id, array $data): ?Task
    {
        $task=$this->task->find($id);
        $status=$task?$task->update($data):null;
        return $status;
    }

    public function delete($id): bool
    {
        $task=$this->task->find($id);
        $status=$task?$task->update(['is_active'=>0]):null;
        return $status;

    }
}
