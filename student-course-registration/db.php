<?php
// dashboard.php

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$user_id = $_SESSION['user_id'];

// Get real stats
$stats_query = "
    SELECT 
        COUNT(r.id) as course_count,
        SUM(CASE WHEN r.status = 'approved' THEN c.credit_hours ELSE 0 END) as total_credits
    FROM registrations r
    LEFT JOIN courses c ON r.course_id = c.id
    WHERE r.user_id = ?
";

$stmt = $conn->prepare($stats_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stats = $stmt->get_result()->fetch_assoc();

$course_count = $stats['course_count'] ?? 0;
$total_credits = $stats['total_credits'] ?? 0;

$stmt->close();
$conn->close();

$full_name     = $_SESSION['full_name'] ?? 'Student';
$profile_image = $_SESSION['profile_image'] ?? null;
$initial       = strtoupper(substr($full_name, 0, 1));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CourseLink</title>
    <link rel="stylesheet" href="./styles/base.css">
    <link rel="stylesheet" href="./styles/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    <!-- Top Bar – removed bell icon -->
    <header class="top-bar">
        <button class="hamburger" id="hamburger">
            <i class="fas fa-bars"></i>
        </button>
        
        <div class="brand">
            Course<span>Link</span>
        </div>

        <div class="user-area">
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
            <a href="dashboard.php" class="active"><i class="fas fa-home icon"></i> Dashboard</a>
            <a href="available-courses.php"><i class="fas fa-book icon"></i> Available Courses</a>
            <a href="my-registrations.php"><i class="fas fa-check-circle icon"></i> My Registrations</a>
            <a href="profile.php"><i class="fas fa-user-edit icon"></i> Profile</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt icon"></i> Logout</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <h1 style="color: #2c3e50; margin-bottom: 0.5rem;">Welcome back, <?= htmlspecialchars(explode(' ', $full_name)[0]) ?>!</h1>
        <p style="color: #7f8c8d; margin-bottom: 2rem;">Here's what's happening in your academic journey</p>

        <div class="dashboard-grid">
            <div class="card">
                <div class="card-title">Registered Credits</div>
                <div class="card-value"><?= $total_credits ?> / 18</div>
                <p style="color: #95a5a6; margin-top: 0.5rem;">Current semester</p>
            </div>

            <div class="card">
                <div class="card-title">Courses Registered</div>
                <div class="card-value"><?= $course_count ?></div>
                <p style="color: #95a5a6; margin-top: 0.5rem;">This semester</p>
            </div>

            <div class="card">
                <div class="card-title">GPA (Cumulative)</div>
                <div class="card-value">3.68</div>
                <p style="color: #95a5a6; margin-top: 0.5rem;">↑ 0.12 from last semester</p>
            </div>

            <div class="card">
                <div class="card-title">Next Deadline</div>
                <div class="card-value" style="color: #e67e22;">7 days</div>
                <p style="color: #95a5a6; margin-top: 0.5rem;">March 10, 2026</p>
            </div>
        </div>
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