<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getAll() 
    {
        $tasks = Task::all();

        return $tasks;
    }

    public function getOne($id)
    {
        $task = Task::findOrFail($id);

        return $task;
    }
}
