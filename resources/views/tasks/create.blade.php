<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task | Student Portal</title>

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

        h1 { margin-top: 0; }

        label {
            display: block;
            margin: 18px 0 8px;
            font-weight: bold;
        }

        input, textarea, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            font-size: 15px;
        }

        textarea {
            resize: vertical;
            min-height: 110px;
        }

        button {
            background: #2563eb;
            color: white;
            padding: 13px 20px;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            margin-top: 22px;
            width: 100%;
            font-size: 15px;
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
        ← Back to My Tasks
    </a>

    <h1>Add New Task</h1>
    <p>Create a new task for your course.</p>

    @if($errors->any())
        <div class="alert">
            Please correct the errors below.
        </div>
    @endif

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <label>Select Course</label>
        <select name="course_id" required>
            <option value="">-- Select Course --</option>

            @foreach($courses as $course)
                <option value="{{ $course->id }}"
                    {{ old('course_id') == $course->id ? 'selected' : '' }}>
                    {{ $course->title }}
                </option>
            @endforeach
        </select>

        @error('course_id')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Task Title</label>
        <input
            type="text"
            name="title"
            value="{{ old('title') }}"
            placeholder="Enter task title"
            required
        >

        @error('title')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Description</label>
        <textarea
            name="description"
            placeholder="Enter task description"
        >{{ old('description') }}</textarea>

        @error('description')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Due Date</label>
        <input
            type="date"
            name="due_date"
            value="{{ old('due_date') }}"
        >

        @error('due_date')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit">Save Task</button>

    </form>

</div>

</body>
</html>