    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task | Student Portal</title>

    <style>
        * { box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6fb;
            padding: 30px;
            color: #1e293b;
        }

        .container {
            max-width: 650px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.06);
        }

        label {
            display: block;
            margin: 18px 0 8px;
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            font-size: 15px;
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        button {
            background: #2563eb;
            color: white;
            padding: 13px;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            margin-top: 22px;
            width: 100%;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            color: #2563eb;
            text-decoration: none;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }

        .alert {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 7px;
        }
    </style>
</head>

<body>

<div class="container">

    <a href="{{ route('tasks.index') }}" class="back">
        ← Back to Tasks
    </a>

    <h1>Edit Task</h1>
    <p>Update your school activity.</p>

    @if($errors->any())
        <div class="alert">
            Please correct the errors below.
        </div>
    @endif

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Task Title</label>
        <input
            type="text"
            name="title"
            value="{{ old('title', $task->title) }}"
            required
        >
        @error('title')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Course</label>
        <select name="course_id" required>
            @foreach($courses as $course)
                <option value="{{ $course->id }}"
                    {{ old('course_id', $task->course_id) == $course->id ? 'selected' : '' }}>
                    {{ $course->code }} - {{ $course->title }}
                </option>
            @endforeach
        </select>
        @error('course_id')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Description</label>
        <textarea name="description">{{ old('description', $task->description) }}</textarea>

        <label>Due Date</label>
        <input
            type="date"
            name="due_date"
            value="{{ old('due_date', $task->due_date) }}"
        >
        @error('due_date')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Status</label>
        <select name="status" required>
            <option value="pending"
                {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>
                Pending
            </option>

            <option value="completed"
                {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>
                Completed
            </option>
        </select>

        <button type="submit">Update Task</button>

    </form>

</div>

</body>
</html>
