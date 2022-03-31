<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function getAll() 
    {
        Log::info('GetAll tasks');
        try {
            $tasks = Task::all();
            
            Log::info('Tasks done');

            return $tasks;
        } catch (\Exception $exception) {
            Log::error('Error-> '.$exception->getMessage());

            return ['error' => $exception->getMessage()];
        }
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required',
            'user_id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }   

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id
        ];

        Task::create($data);

        return 'Task created';
    }

    public function getAllByUser($userId)
    {
        $tasksByUserId = User::find($userId)->tasks;

        $user = User::find($userId)->toArray();

        $response = [
            'user' => $user,
            'tasks' => $tasksByUserId
        ];

        return $response;
    }

    public function exampleMiddleware()
    {
        return 'Middleware';
    }
}
