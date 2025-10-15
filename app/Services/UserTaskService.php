<?php

namespace App\Services;

use App\Http\Resources\TaskResourceCollection;
use Illuminate\Support\Facades\Auth;

class UserTaskService
{
    public function getTasks()
    {
        $user=Auth::user();
        $tasks=$user->tasks()->paginate(2);
        return $tasks;
    }
}
