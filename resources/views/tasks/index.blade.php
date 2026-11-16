
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tasks | Student Portal</title>

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <style>
        * {
            box-sizing: border-box;
        }

        .tasks-content {
            padding: 30px;
        }

        .task-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 15px;
        }

        .task-header h1 {
            margin-bottom: 8px;
        }

        .task-header p {
            color: #64748b;
        }

        .add-btn {
            background: #2563eb;
            color: white;
            padding: 12px 18px;
            text-decoration: none;
            border-radius: 8px;
            display: inline-block;
        }

        .add-btn:hover {
            background: #1d4ed8;
        }

        /* SUMMARY CARDS */

        .task-summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .summary-card {
            background: white;
            padding: 22px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .summary-card h3 {
            font-size: 28px;
            margin: 0 0 8px;
            color: #2563eb;
        }

        .summary-card p {
            margin: 0;
            color: #64748b;
        }

        /* ALERT */

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        /* TASK CARDS */

        .task-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .task-top {
            display: flex;
            justify-content: space-between;
            gap: 15px;
        }

        .task-top h3 {
            margin-top: 0;
            color: #1e293b;
        }

        .task-info {
            color: #64748b;
            margin: 8px 0;
        }

        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            height: fit-content;
        }

        .pending {
            background: #fef3c7;
            color: #92400e;
        }

        .completed {
            background: #dcfce7;
            color: #166534;
        }

        /* ACTION BUTTONS */

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 18px;
            flex-wrap: wrap;
        }

        .actions a,
        .actions button {
            padding: 8px 13px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            font-size: 13px;
        }

        .edit {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .complete {
            background: #dcfce7;
            color: #166534;
        }

        .delete {
            background: #fee2e2;
            color: #b91c1c;
        }

        .empty {
            background: white;
            padding: 45px;
            text-align: center;
            border-radius: 12px;
        }

        .empty h2 {
            color: #1e293b;
        }

        .empty p {
            color: #64748b;
            margin-bottom: 25px;
        }

        @media(max-width: 900px) {
            .task-summary {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 600px) {
            .tasks-content {
                padding: 15px;
            }

            .task-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .task-summary {
                grid-template-columns: 1fr;
            }

            .task-top {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<div class="dashboard-container">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="sidebar-brand">
            <div class="brand-logo">SP</div>
            <h2>Student Portal</h2>
        </div>

        <p class="menu-label">MAIN MENU</p>

        <nav class="sidebar-nav">

            <a href="{{ route('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span>▦</span> Dashboard
            </a>

            <a href="{{ route('my-courses') }}"
               class="nav-link {{ request()->routeIs('my-courses') ? 'active' : '' }}">
                <span>▤</span> My Courses
            </a>

            <a href="{{ route('tasks.index') }}"
               class="nav-link {{ request()->routeIs('tasks.*') ? 'active' : '' }}">
                <span>▣</span> My Tasks
            </a>

            <a href="{{ route('dashboard') }}#announcements"
               class="nav-link">
                <span>◉</span> Announcements
            </a>

        </nav>

        <div class="sidebar-bottom">

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="logout-button">
                    ↪ Logout
                </button>
            </form>

        </div>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">

        <div class="tasks-content">

            <!-- HEADER -->
            <div class="task-header">

                <div>
                    <h1>My Tasks</h1>
                    <p>Manage your school activities and deadlines.</p>
                </div>

                <a href="{{ route('tasks.create') }}" class="add-btn">
                    + Add New Task
                </a>

            </div>

            <!-- SUCCESS MESSAGE -->
            @if(session('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- SUMMARY CARDS -->
            <div class="task-summary">

                <div class="summary-card">
                    <h3>{{ $totalTasks }}</h3>
                    <p>Total Tasks</p>
                </div>

                <div class="summary-card">
                    <h3>{{ $pendingTasks }}</h3>
                    <p>Pending Tasks</p>
                </div>

                <div class="summary-card">
                    <h3>{{ $completedTasks }}</h3>
                    <p>Completed Tasks</p>
                </div>

            </div>

            <!-- TASK LIST -->
            @forelse($tasks as $task)

                <div class="task-card">

                    <div class="task-top">

                        <div>

                            <h3>{{ $task->title }}</h3>

                            <p class="task-info">
                                <strong>Course:</strong>
                                {{ $task->course->title ?? 'No course' }}
                            </p>

                            @if($task->description)
                                <p class="task-info">
                                    {{ $task->description }}
                                </p>
                            @endif

                            <p class="task-info">
                                <strong>Due Date:</strong>

                                @if($task->due_date)
                                    {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                @else
                                    No deadline
                                @endif
                            </p>

                        </div>

                        <span class="status {{ $task->status }}">
                            {{ ucfirst($task->status) }}
                        </span>

                    </div>

                    <!-- ACTIONS -->
                    <div class="actions">

                        <a href="{{ route('tasks.edit', $task->id) }}"
                           class="edit">
                            Edit
                        </a>

                        @if($task->status === 'pending')

                            <form action="{{ route('tasks.complete', $task->id) }}"
                                  method="POST">

                                @csrf
                                @method('PATCH')

                                <button type="submit" class="complete">
                                    Mark Completed
                                </button>

                            </form>

                        @endif

                        <form action="{{ route('tasks.destroy', $task->id) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this task?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="delete">
                                Delete
                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <!-- EMPTY STATE -->
                <div class="empty">

                    <h2>No Tasks Yet</h2>

                    <p>
                        You haven't added any tasks.
                        Start organizing your school activities!
                    </p>

                    <a href="{{ route('tasks.create') }}" class="add-btn">
                        + Create Your First Task
                    </a>

                </div>

            @endforelse

        </div>

    </main>

</div>

</body>
</html>
