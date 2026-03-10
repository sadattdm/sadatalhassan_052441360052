<?php
// available-courses.php

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

include 'db.php';

// Fetch all active courses
$query = "SELECT * FROM courses WHERE is_active = 1 ORDER BY level, course_code";
$result = $conn->query($query);

$courses = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
}

// Prepare a quick check for registered courses (more efficient)
$registered_ids = [];
$reg_stmt = $conn->prepare("SELECT course_id FROM registrations WHERE user_id = ?");
$reg_stmt->bind_param("i", $_SESSION['user_id']);
$reg_stmt->execute();
$reg_result = $reg_stmt->get_result();
while ($r = $reg_result->fetch_assoc()) {
    $registered_ids[] = $r['course_id'];
}
$reg_stmt->close();

// Close connection only AFTER all queries are done
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Courses - CourseLink</title>
    <link rel="stylesheet" href="./styles/base.css">
    <link rel="stylesheet" href="./styles/dashboard.css"> <!-- Reusing sidebar/topbar styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 1.8rem;
            margin-top: 2rem;
        }

        .course-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
            transition: all 0.28s ease;
            border: 1px solid #e9ecef;
        }

        .course-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.12);
            border-color: #27ae60;
        }

        .course-header {
            background: linear-gradient(135deg, #27ae60, #1e8449);
            color: white;
            padding: 1.4rem 1.6rem;
            position: relative;
        }

        .course-code-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255,255,255,0.25);
            backdrop-filter: blur(4px);
            padding: 0.35rem 0.9rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .course-title {
            font-size: 1.4rem;
            margin: 0.4rem 0 0.6rem;
            font-weight: 700;
        }

        .course-body {
            padding: 1.5rem;
            flex: 1;
        }

        .course-meta {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1rem;
            font-size: 0.95rem;
            color: #555;
        }

        .course-meta-item i {
            color: #27ae60;
            margin-right: 0.4rem;
        }

        .course-desc {
            color: #555;
            line-height: 1.6;
            font-size: 0.97rem;
        }

        .course-desc.truncated {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .course-actions {
            padding: 1.2rem 1.5rem;
            border-top: 1px solid #eee;
            text-align: right;
        }

        .btn-register {
            background: #27ae60;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.25s;
        }

        .btn-register:hover {
            background: #1e8449;
            transform: translateY(-2px);
        }

        .no-courses {
            text-align: center;
            padding: 4rem 1rem;
            color: #777;
            font-size: 1.3rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        }

        @media (max-width: 768px) {
            .courses-grid {
                grid-template-columns: 1fr;
                gap: 1.4rem;
            }
            
            .course-title {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>

    <!-- Top Bar -->
    <header class="top-bar">
        <button class="hamburger" id="hamburger">
            <i class="fas fa-bars"></i>
        </button>
        
        <div class="brand">
            Course<span>Link</span>
        </div>

        <div class="user-area">
            <div class="notification-bell">
                <i class="fas fa-bell"></i>
            </div>
            
            <?php 
            $profile_image = $_SESSION['profile_image'] ?? null;
            $full_name = $_SESSION['full_name'] ?? 'Student';
            $initial = strtoupper(substr($full_name, 0, 1));
            ?>
            <?php if ($profile_image): ?>
                <img src="<?= htmlspecialchars($profile_image) ?>" alt="Profile" class="user-avatar">
            <?php else: ?>
                <div class="user-avatar-initial"><?= $initial ?></div>
            <?php endif; ?>
            
            <span><?= htmlspecialchars($full_name) ?></span>
        </div>
    </header>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            Student Portal
        </div>
        <nav class="sidebar-menu">
             <a href="dashboard.php"><i class="fas fa-home icon"></i> Dashboard</a>
            <a href="available-courses.php"><i class="fas fa-book icon"></i> Available Courses</a>
            <a href="my-registrations.php"><i class="fas fa-check-circle icon"></i> My Registrations</a>
            <a href="profile.php"><i class="fas fa-user-edit icon"></i> Profile</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt icon"></i> Logout</a>
        </nav>
    </aside>

    <main class="main-content">
        <h1 style="color: #2c3e50; margin-bottom: 0.4rem;">Available Courses</h1>
        <p style="color: #7f8c8d; margin-bottom: 2rem;">Select courses for the current semester</p>

        <!-- Flash message from registration -->
        <?php if (isset($_SESSION['reg_message'])): ?>
            <?php 
            $msg_class = ($_SESSION['reg_type'] ?? 'error') === 'success' ? 'alert-success' : 'alert-danger';
            ?>
            <div class="alert <?= $msg_class ?>" style="margin-bottom: 1.8rem;">
                <?= htmlspecialchars($_SESSION['reg_message']) ?>
            </div>
            <?php 
            unset($_SESSION['reg_message']);
            unset($_SESSION['reg_type']);
            ?>
        <?php endif; ?>

        <?php if (empty($courses)): ?>
            <div class="no-courses">
                <i class="fas fa-book-open fa-3x" style="color:#ddd; margin-bottom:1rem;"></i>
                <p>No courses available right now.</p>
                <p>Please check back later or contact your academic advisor.</p>
            </div>
        <?php else: ?>
            <div class="courses-grid">
                <?php foreach ($courses as $course): ?>
                    <?php 
                    $is_registered = in_array($course['id'], $registered_ids);
                    ?>
                    <div class="course-card">
                        <div class="course-header">
                            <div class="course-code-badge">
                                <?= htmlspecialchars($course['course_code']) ?>
                            </div>
                            <div class="course-title"><?= htmlspecialchars($course['course_title']) ?></div>
                        </div>

                        <div class="course-body">
                            <div class="course-meta">
                                <span class="course-meta-item">
                                    <i class="fas fa-graduation-cap"></i> <?= $course['level'] ?> Level
                                </span>
                                <span class="course-meta-item">
                                    <i class="fas fa-clock"></i> <?= $course['credit_hours'] ?> Credits
                                </span>
                            </div>

                            <div class="course-info" style="margin-bottom:1rem;">
                                <strong>Department:</strong> <?= htmlspecialchars($course['department']) ?>
                            </div>

                            <?php if (!empty($course['description'])): ?>
                                <div class="course-desc truncated">
                                    <?= nl2br(htmlspecialchars($course['description'])) ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="course-actions">
                            <?php if ($is_registered): ?>
                                <button class="btn" style="background:#95a5a6; color:white; cursor:default;" disabled>
                                    <i class="fas fa-check-circle" style="margin-right:0.5rem;"></i>
                                    Registered
                                </button>
                            <?php else: ?>
                                <form action="register-course.php" method="POST">
                                    <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                                    <button type="submit" name="register_course" class="btn btn-register">
                                        <i class="fas fa-plus-circle" style="margin-right:0.5rem;"></i>
                                        Register Course
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <script>
        const hamburger = document.getElementById('hamburger');
        const sidebar   = document.getElementById('sidebar');

        hamburger?.addEventListener('click', () => {
            sidebar.classList.toggle('open');
        });

        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 992) {
                if (!sidebar.contains(e.target) && !hamburger.contains(e.target)) {
                    sidebar.classList.remove('open');
                }
            }
        });
    </script>

</body>
</html>