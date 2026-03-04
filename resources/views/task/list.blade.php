<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task</title>
</head>
<body>
 <a href="{{ route('task.add') }}">Add Task</a>
<table border="1">
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Due Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->status }}</td>
                <td>{{ $task->due_date }}</td>
                <td>
                    <a href="{{ route('task.edit', $task->id) }}">Edit</a>
                    <form action="{{ route('task.delete', $task->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No tasks found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
</body>
</html>