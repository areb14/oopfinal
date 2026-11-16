
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details | Student Portal</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6fb;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        .course-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.06);
        }

        h1 {
            color: #2563eb;
        }

        .code {
            color: #777;
        }

        .description {
            color: #555;
            line-height: 1.7;
        }

        .tasks {
            margin-top: 30px;
        }

        .task-item {
            background: #f8fafc;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 12px;
        }

        .back-btn {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            margin-top: 20px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="course-card">

        <h1>{{ $course->title }}</h1>

        <p class="code">
            Course Code: {{ $course->code }}
        </p>

        <h3>Course Description</h3>

        <p class="description">
            {{ $course->description ?? 'No description available.' }}
        </p>

        <div class="tasks">

            <h2>Course Tasks</h2>

            @forelse($course->tasks as $task)

                <div class="task-item">
                    <strong>{{ $task->title }}</strong>
                </div>

            @empty

                <p>No tasks available for this course yet.</p>

            @endforelse

        </div>

        <a href="{{ route('my-courses') }}" class="back-btn">
            Back to My Courses
        </a>

    </div>

</div>

</body>
</html>
