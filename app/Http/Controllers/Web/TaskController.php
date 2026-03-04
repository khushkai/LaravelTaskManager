<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
   
    public function dashboard(){
        return  view('dashboard');
    }

    public function index()
    {
        $this->authorize('viewAny', Task::class);
        if(auth()->user()->role === 'admin' ){
            $tasks=Task::all();
        }else{
            $tasks=Task::where('user_id',auth()->id())->get();
        }
        return view('task.list', compact('tasks'));
    }

    public function create()
    {
        $this->authorize('create', Task::class);
        return view('task.add');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Task::class);
        $request->validate([
            'title'=>'required|',
            'description' => 'required|string|max:255',
            'status'=>'required',
            'due_date'=>'required',
        ]);
        Task::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);
        return redirect()->route('task.list')->with('success','Task is Inserted Successfully!'); 
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return view('task.task', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('task.add', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $request->validate([
            'title' => 'required',
            'description' => 'required|string|max:255',
            'status' => 'required',
            'due_date' => 'required',
        ]);
        $task->update($request->only([
            'title',
            'description',
            'status',
            'due_date'
        ]));
        return redirect()->route('task.list')
            ->with('success', 'Task Updated Successfully!');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return back()->with('success', 'Task Deleted Successfully!');
    }
}
