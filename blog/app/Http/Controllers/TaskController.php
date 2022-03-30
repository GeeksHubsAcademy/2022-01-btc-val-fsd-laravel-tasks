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

    public function delete($id)
    {
        $task = Task::findOrFail($id);

        $task->delete();

        return 'Task deleted';
    }

    public function create(Request $request)
    {
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id
        ];

        Task::create($data);

        return 'Task created';
    }
}
