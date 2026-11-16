
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course | Student Portal</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6fb;
            margin: 0;
            padding: 40px 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        h2 {
            color: #1e293b;
            margin-top: 0;
        }

        label {
            display: block;
            margin: 18px 0 8px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 7px;
            font-size: 15px;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            margin-top: 20px;
        }

        .update-btn {
            background: #2563eb;
            color: white;
        }

        .cancel-btn {
            background: #e5e7eb;
            color: #333;
            margin-left: 8px;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-top: 5px;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Edit Course</h2>
    <p>Update your course information below.</p>

    <form action="{{ route('courses.update', $course->id) }}" method="POST">

        @csrf
        @method('PUT')

        <label>Course Title</label>
        <input
            type="text"
            name="title"
            value="{{ old('title', $course->title) }}"
            required
        >
        @error('title')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Description</label>
        <textarea name="description">{{ old('description', $course->description) }}</textarea>
        @error('description')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn update-btn">
            Update Course
        </button>

        <a href="{{ route('my-courses') }}" class="btn cancel-btn">
            Cancel
        </a>

    </form>

</div>

</body>
</html>
