<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add / Edit Task</title>
</head>
<body>

    <form method="POST" 
    action="{{ !empty($task) ? route('task.update', $task->id) : route('task.store') }}">
    
    @csrf

    @if(!empty($task))
        @method('PUT')
    @endif

    <label>Title</label>
    <input type="text" name="title" 
        value="{{ old('title', $task->title ?? '') }}">
    @error('title') 
        <div style="color:red">{{ $message }}</div> 
    @enderror

    <label>Description</label>
    <input type="text" name="description" 
        value="{{ old('description', $task->description ?? '') }}">
    @error('description') 
        <div style="color:red">{{ $message }}</div> 
    @enderror

    <label>Status</label>
    <input type="text" name="status" 
        value="{{ old('status', $task->status ?? '') }}">
    @error('status') 
        <div style="color:red">{{ $message }}</div> 
    @enderror

    <label>Due Date</label>
    <input type="date" name="due_date"
    value="{{ old('due_date', isset($task) && $task->due_date ? $task->due_date->format('Y-m-d') : '') }}">
    @error('due_date') 
        <div style="color:red">{{ $message }}</div> 
    @enderror

    <button type="submit">
        {{ !empty($task) ? 'Update Task' : 'Save Task' }}
    </button>

</form>

</body>
</html>