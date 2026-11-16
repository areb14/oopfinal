
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Course | Student Portal</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6fb;
            margin: 0;
            padding: 40px 20px;
            color: #1e293b;
        }

        .container {
            max-width: 650px;
            margin: 30px auto;
        }

        .back-btn {
            display: inline-block;
            text-decoration: none;
            color: #2563eb;
            font-weight: bold;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .back-btn:hover {
            color: #1d4ed8;
        }

        .course-card {
            background: white;
            padding: 35px;
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.06);
        }

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0 0 10px;
            font-size: 27px;
            color: #1e293b;
        }

        .header p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            margin-bottom: 9px;
            font-weight: bold;
            font-size: 14px;
            color: #334155;
        }

        input, textarea {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #dbe2ea;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            font-family: Arial, sans-serif;
            transition: 0.2s;
        }

        input:focus, textarea:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 6px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        .save-btn {
            flex: 1;
            background: #2563eb;
            color: white;
            border: none;
            padding: 13px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }

        .save-btn:hover {
            background: #1d4ed8;
        }

        .cancel-btn {
            flex: 1;
            background: #e2e8f0;
            color: #334155;
            text-align: center;
            text-decoration: none;
            padding: 13px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
        }

        .cancel-btn:hover {
            background: #cbd5e1;
        }

        @media (max-width: 500px) {
            .course-card {
                padding: 22px;
            }

            .button-group {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="course-card">

        <div class="header">
            <h1>Add New Course</h1>
            <p>Fill in the details below to create a new course.</p>
        </div>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('courses.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Course Title</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title') }}"
                    placeholder="Enter course title"
                    required
                >

                @error('title')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <input
                    type="text"
                    id="code"
                    name="code"
                    value="{{ old('code') }}"
                    placeholder="Example: BSIT 101"
                    required
                >

                @error('code')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea
                    id="description"
                    name="description"
                    placeholder="Enter course description..."
                >{{ old('description') }}</textarea>

                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="button-group">
                <button type="submit" class="save-btn">
                    + Save Course
                </button>

                <a href="{{ route('my-courses') }}" class="cancel-btn">
                    Back to My Courses
                </a>
            </div>

        </form>

    </div>
</div>

</body>
</html>