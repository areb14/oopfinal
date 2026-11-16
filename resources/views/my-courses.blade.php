
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses | Student Portal</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

   
<style>
    .course-card {
        display: flex;
        flex-direction: column;
    }

    .course-card .view-btn {
        display: inline-block;
        width: fit-content;
        margin-top: 12px;
    }

    .course-actions {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        justify-content: flex-start !important;
        gap: 10px;
        margin-top: 18px;
        width: 100%;
    }

    .course-actions form {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .course-actions .edit-btn,
    .course-actions .delete-btn {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 105px !important;
        height: 40px !important;
        min-width: 105px !important;
        margin: 0 !important;
        padding: 0 10px !important;
        border: none !important;
        border-radius: 6px !important;
        font-family: Arial, sans-serif;
        font-size: 13px !important;
        font-weight: bold !important;
        line-height: 1 !important;
        text-decoration: none !important;
        white-space: nowrap;
        box-sizing: border-box !important;
        cursor: pointer;
    }

    .course-actions .edit-btn {
        background-color: #2563eb !important;
        color: white !important;
    }

    .course-actions .delete-btn {
        background-color: #dc2626 !important;
        color: white !important;
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
                <span></span> My Courses
            </a>

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
                <h2>My Courses</h2>
                <p>Manage and explore your enrolled courses.</p>
            </div>

            <div class="student-info">
                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div>
                    <strong>{{ auth()->user()->name }}</strong>
                    <small>Student</small>
                </div>
            </div>
        </header>

        <!-- WELCOME BANNER -->
        <section class="welcome-banner">
            <div>
                <span>STUDENT LEARNING PORTAL</span>
                <h1>My Learning Journey 📚</h1>
                <p>
                    View your enrolled courses and continue
                    your academic journey.
                </p>
            </div>

            <div class="banner-icon">🎓</div>
        </section>

        <!-- COURSE CONTENT -->
        <section class="content-section">

            <div class="section-heading">
                <div>
                    <h2>Enrolled Courses</h2>
                    <p>All your currently enrolled subjects.</p>
                </div>

                <a href="{{ route('courses.create') }}" class="add-course-btn">
                    + Add New Course
                </a>
            </div>

            @if(session('success'))
                <div style="background:#dcfce7; color:#166534; padding:12px; border-radius:7px; margin-bottom:15px;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="course-grid">

                @forelse($courses as $course)

                    <div class="course-card">

                        <div class="course-icon blue">💻</div>

                        <span class="course-code">
                            {{ $course->code }}
                        </span>

                        <h3>{{ $course->title }}</h3>

                        <p>
                            {{ $course->description ?? 'No description available.' }}
                        </p>

                        <!-- VIEW BUTTON -->
                        <a class="view-btn"
                           href="{{ route('courses.show', $course->id) }}">
                            View Course →
                        </a>

                        <!-- EDIT AND DELETE BUTTONS -->
                        <div class="course-actions">

                            <a href="{{ route('courses.edit', $course->id) }}"
                               class="edit-btn">
                                ✏ Edit
                            </a>

                            <form action="{{ route('courses.destroy', $course->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this course?');">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="delete-btn">
                                    🗑 Delete
                                </button>

                            </form>

                        </div>

                    </div>

                @empty

                    <div class="content-panel">
                        <h3>No Enrolled Courses Yet</h3>
                        <p>
                            Your enrolled courses will appear here.
                        </p>
                    </div>

                @endforelse

            </div>

        </section>

        <footer class="dashboard-footer">
            © 2026 Student Portal. All rights reserved.
        </footer>

    </main>

</div>

</body>
</html>
