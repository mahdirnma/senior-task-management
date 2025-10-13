<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTaskController extends Controller
{
    public function index(){
        $user=Auth::user();
        $tasks=$user->tasks()->paginate(2);
        return view('user.index',compact('tasks'));
    }
}
