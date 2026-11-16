
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard | Student Portal</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
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

    <a href="{{ route('tasks.index') }}"
       class="nav-link {{ request()->routeIs('tasks.*') ? 'active' : '' }}">
        <span>▣</span> My Tasks
    </a>

    <a href="#announcements" class="nav-link">
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

        <header class="topbar">
            <div>
                <h2>Dashboard</h2>
                <p>Welcome to your learning space.</p>
            </div>

            <div class="student-info">
                <div class="avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <div>
                    <strong>{{ $user->name }}</strong>
                    <small>Student</small>
                </div>
            </div>
        </header>

        <!-- WELCOME BANNER -->
        <section class="welcome-banner">
            <div>
                <span>STUDENT LEARNING PORTAL</span>

                <h1>Hello, {{ $user->name }}!</h1>

                <p>
                    Continue your learning journey.
                    Explore your courses and complete your assignments.
                </p>
            </div>

            <div class="banner-icon">🎓</div>
        </section>

        <!-- SUMMARY CARDS -->
        <section class="stats-grid">

            <div class="stat-card">
                <div class="stat-icon blue">📚</div>
                <div>
                    <p>Enrolled Courses</p>
                    <h2>{{ $totalCourses }}</h2>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon orange">📝</div>
                <div>
                    <p>Pending Tasks</p>
                    <h2>{{ $pendingTasks }}</h2>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon green">✓</div>
                <div>
                    <p>Completed Tasks</p>
                    <h2>{{ $completedTasks }}</h2>
                </div>
            </div>

        </section>

        <!-- COURSES -->
        <section class="content-section" id="courses">

            <div class="section-heading">
                <div>
                    <h2>My Courses</h2>
                    <p>Explore your enrolled subjects.</p>
                </div>
            </div>

            <div class="course-grid">

                @forelse($user->courses as $course)

                    <div class="course-card">
                        <div class="course-icon blue">💻</div>

                        <span class="course-code">
                            {{ $course->code }}
                        </span>

                        <h3>{{ $course->title }}</h3>

                        <p>{{ $course->description }}</p>

                    </div>

                @empty

                    <p>No courses enrolled yet.</p>

                @endforelse

            </div>

        </section>

        <!-- RECENT TASKS AND ANNOUNCEMENTS -->
        <section class="bottom-grid">

            <div class="content-panel" id="assignments">

                <h2>Recent Tasks</h2>
                <p class="panel-subtitle">Your latest activities.</p>

                @forelse($recentTasks as $task)

                    <div class="assignment-item">

                        <div class="assignment-icon">📝</div>

                        <div class="assignment-details">
                            <strong>{{ $task->title }}</strong>

                            <small>
                                {{ $task->course->title ?? 'No Course' }}
                            </small>
                        </div>

                        <span class="status {{ $task->status == 'completed' ? 'completed' : 'pending' }}">
                            {{ ucfirst($task->status) }}
                        </span>

                    </div>

                @empty

                    <p>No tasks available.</p>

                @endforelse

                <p>
                    <a href="{{ route('tasks.index') }}">View All Tasks →</a>
                </p>

            </div>

            <div class="content-panel" id="announcements">

                <h2>Announcements</h2>
                <p class="panel-subtitle">Latest academic updates.</p>

                <div class="announcement-item">
                    <span class="announcement-dot"></span>
                    <div>
                        <strong>Welcome Students!</strong>
                        <p>Welcome to the Student Learning Portal.</p>
                        <small>November 2026</small>
                    </div>
                </div>

                <div class="announcement-item">
                    <span class="announcement-dot orange-dot"></span>
                    <div>
                        <strong>Assignment Reminder</strong>
                        <p>Please check your upcoming activities.</p>
                        <small>November 2026</small>
                    </div>
                </div>

            </div>

        </section>

        <footer class="dashboard-footer">
            © 2026 Student Portal. All rights reserved.
        </footer>

    </main>
</div>

</body>
</html>
