<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TaskApiController extends Controller
{

    public function index()
    {
        $this->authorize('viewAny', Task::class);

        if (auth()->user()->role === 'admin') {
            $tasks = Task::all();
        } else {
            $tasks = Task::where('user_id', auth()->id())->get();
        }

        return response()->json([
            'status' => true,
            'data' => $tasks,
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Task::class);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|string',
            'due_date' => 'required|date'
        ]);

        $task = Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        return response()->json([
            'status' => true,
            'data' => $task,
            'message' => 'Task inserted successfully!'
        ], 201);
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return response()->json([
            'success' => true,
            'data' => $task
        ]);
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|string',
            'due_date' => 'required|date'
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        return response()->json([
            'status' => true,
            'data' => $task,
            'message' => 'Task updated successfully!'
        ]);
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return response()->json([
            'status' => true,
            'message' => 'Task deleted successfully!'
        ]);
    }
}
   

