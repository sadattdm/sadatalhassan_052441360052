<?php
// my-registrations.php

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$user_id = $_SESSION['user_id'];

// Get registered courses + total credits
$query = "
    SELECT 
        c.id,
        c.course_code,
        c.course_title,
        c.credit_hours,
        c.level,
        c.department,
        r.registered_at,
        r.status
    FROM registrations r
    JOIN courses c ON r.course_id = c.id
    WHERE r.user_id = ?
    ORDER BY r.registered_at DESC
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$registrations = [];
$total_credits = 0;

while ($row = $result->fetch_assoc()) {
    $registrations[] = $row;
    if ($row['status'] === 'approved') {
        $total_credits += $row['credit_hours'];
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Registrations - CourseLink</title>
    <link rel="stylesheet" href="./styles/base.css">
    <link rel="stylesheet" href="./styles/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .registrations-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            margin-top: 1.5rem;
        }

        .registrations-table th,
        .registrations-table td {
            padding: 1.1rem 1.4rem;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .registrations-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #2c3e50;
        }

        .status-badge {
            padding: 0.35rem 0.9rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-approved {
            background: #d4edda;
            color: #155724;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-dropped {
            background: #f8d7da;
            color: #721c24;
        }

        .total-credits {
            font-size: 1.6rem;
            font-weight: 700;
            color: #27ae60;
            margin-top: 1rem;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 1rem;
            color: #777;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        }
    </style>
</head>
<body>

    <!-- Top Bar (without bell) -->
    <header class="top-bar">
        <button class="hamburger" id="hamburger">
            <i class="fas fa-bars"></i>
        </button>
        
        <div class="brand">
            Course<span>Link</span>
        </div>

        <div class="user-area">
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
        <h1 style="color: #2c3e50; margin-bottom: 0.4rem;">My Registrations</h1>
        <p style="color: #7f8c8d; margin-bottom: 1.5rem;">Courses you have registered for this semester</p>

        <?php if (empty($registrations)): ?>
            <div class="empty-state">
                <i class="fas fa-folder-open fa-3x" style="color:#ddd; margin-bottom:1rem;"></i>
                <p>You haven't registered for any courses yet.</p>
                <p><a href="available-courses.php" style="color:#27ae60; font-weight:600;">Browse available courses →</a></p>
            </div>
        <?php else: ?>
            <div style="margin-bottom: 1.5rem;">
                <strong>Total Registered Credits:</strong>
                <span class="total-credits"><?= $total_credits ?></span>
                <span style="color:#7f8c8d;"> / 18</span>
            </div>

            <table class="registrations-table">
                <thead>
                    <tr>
                        <th>Course Code</th>
                        <th>Title</th>
                        <th>Credits</th>
                        <th>Level</th>
                        <th>Department</th>
                        <th>Registered On</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registrations as $reg): ?>
                        <tr>
                            <td><?= htmlspecialchars($reg['course_code']) ?></td>
                            <td><?= htmlspecialchars($reg['course_title']) ?></td>
                            <td><?= $reg['credit_hours'] ?></td>
                            <td><?= $reg['level'] ?> Level</td>
                            <td><?= htmlspecialchars($reg['department']) ?></td>
                            <td><?= date('M d, Y', strtotime($reg['registered_at'])) ?></td>
                            <td>
                                <span class="status-badge status-<?= strtolower($reg['status']) ?>">
                                    <?= ucfirst($reg['status']) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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