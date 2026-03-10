<?php
// profile.php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$user_id = $_SESSION['user_id'];
$message = '';
$message_type = 'error';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $profile_image = $_SESSION['profile_image'] ?? null;

    if (!empty($_FILES['profile_image']['name'])) {
        $target_dir = "uploads/profile/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0755, true);

        $file_name   = time() . "_" . basename($_FILES["profile_image"]["name"]);
        $target_file = $target_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed)) {
            $message = "Only JPG, JPEG, PNG & GIF files are allowed.";
        } elseif ($_FILES["profile_image"]["size"] > 2000000) {
            $message = "Image is too large (max 2MB).";
        } elseif (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            $profile_image = $target_file;

            $stmt = $conn->prepare("UPDATE users SET profile_image = ? WHERE id = ?");
            $stmt->bind_param("si", $profile_image, $user_id);
            if ($stmt->execute()) {
                $_SESSION['profile_image'] = $profile_image;
                $message = "Profile picture updated successfully!";
                $message_type = 'success';
            } else {
                $message = "Failed to update profile: " . $conn->error;
            }
            $stmt->close();
        } else {
            $message = "Failed to upload image.";
        }
    }
}

$user_query = "SELECT full_name, username, email, profile_image, created_at FROM users WHERE id = ?";
$user_stmt = $conn->prepare($user_query);
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user = $user_stmt->get_result()->fetch_assoc();
$user_stmt->close();

$initial = strtoupper(substr($user['full_name'] ?? 'S', 0, 1));

$stats_query = "SELECT COUNT(r.id) as course_count, SUM(CASE WHEN r.status = 'approved' THEN c.credit_hours ELSE 0 END) as total_credits 
                FROM registrations r LEFT JOIN courses c ON r.course_id = c.id WHERE r.user_id = ?";
$stats_stmt = $conn->prepare($stats_query);
$stats_stmt->bind_param("i", $user_id);
$stats_stmt->execute();
$stats = $stats_stmt->get_result()->fetch_assoc();
$stats_stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - CourseLink</title>
    <link rel="stylesheet" href="./styles/base.css">
    <link rel="stylesheet" href="./styles/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com" rel="stylesheet">
    <style>
        :root {
            --primary: #10b981;
            --primary-dark: #059669;
            --bg-gray: #f8fafc;
            --text-main: #1e293b;
        }
        body { font-family: 'Inter', sans-serif; background-color: var(--bg-gray); color: var(--text-main); }
        
        .profile-card {
            max-width: 800px;
            margin: 2rem auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        .profile-cover {
            height: 140px;
            background: linear-gradient(135deg, var(--primary) 0%, #3b82f6 100%);
        }
        .profile-content {
            padding: 0 2rem 2rem;
            margin-top: -60px;
            text-align: center;
        }
        .profile-avatar-large, .avatar-placeholder {
            width: 130px;
            height: 130px;
            border-radius: 24px;
            border: 5px solid white;
            object-fit: cover;
            background: #f1f5f9;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: 700;
            color: #64748b;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin: 2rem 0;
        }
        .stat-box {
            background: #f8fafc;
            padding: 1.25rem;
            border-radius: 12px;
            border: 1px solid #f1f5f9;
        }
        .stat-box i { color: var(--primary); margin-bottom: 8px; font-size: 1.2rem; }
        .stat-label { display: block; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-value { font-size: 1.25rem; font-weight: 700; }

        .info-group { text-align: left; background: #fff; padding: 1.5rem; border-radius: 12px; border: 1px solid #f1f5f9; }
        .info-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #f8fafc; }
        
        .file-input-wrapper {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #f1f5f9;
        }
        .custom-file-label {
            display: inline-block;
            padding: 10px 20px;
            background: #f1f5f9;
            border: 1px dashed #cbd5e1;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: 0.2s;
        }
        .custom-file-label:hover { background: #e2e8f0; }
        .btn-save {
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
        }
        .alert { padding: 1rem; border-radius: 10px; margin-bottom: 1rem; font-size: 0.9rem; }
        .alert-success { background: #dcfce7; color: #166534; }
        .alert-error { background: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>

    <header class="top-bar">
        <button class="hamburger" id="hamburger"><i class="fas fa-bars"></i></button>
        <div class="brand">Course<span>Link</span></div>
        <div class="user-area">
            <?php if ($user['profile_image']): ?>
                <img src="<?= htmlspecialchars($user['profile_image']) ?>" alt="Profile" class="user-avatar">
            <?php else: ?>
                <div class="user-avatar-initial"><?= $initial ?></div>
            <?php endif; ?>
            <span><?= htmlspecialchars($user['full_name'] ?? 'Student') ?></span>
        </div>
    </header>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">Student Portal</div>
        <nav class="sidebar-menu">
            <a href="dashboard.php"><i class="fas fa-home icon"></i> Dashboard</a>
            <a href="available-courses.php"><i class="fas fa-book icon"></i> Available Courses</a>
            <a href="my-registrations.php"><i class="fas fa-check-circle icon"></i> My Registrations</a>
            <a href="profile.php" class="active"><i class="fas fa-user-edit icon"></i> Profile</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt icon"></i> Logout</a>
        </nav>
    </aside>

    <main class="main-content">
        <div class="profile-card">
            <div class="profile-cover"></div>
            <div class="profile-content">
                <?php if ($user['profile_image']): ?>
                    <img src="<?= htmlspecialchars($user['profile_image']) ?>" class="profile-avatar-large">
                <?php else: ?>
                    <div class="avatar-placeholder"><?= $initial ?></div>
                <?php endif; ?>

                <h2 style="margin: 1rem 0 0.2rem;"><?= htmlspecialchars($user['full_name']) ?></h2>
                <p style="color: #64748b; margin-bottom: 1.5rem;">@<?= htmlspecialchars($user['username']) ?></p>

                <?php if ($message): ?>
                    <div class="alert alert-<?= $message_type ?>"><?= $message ?></div>
                <?php endif; ?>

                <div class="stats-grid">
                    <div class="stat-box">
                        <i class="fas fa-layer-group"></i>
                        <span class="stat-label">Courses</span>
                        <span class="stat-value"><?= $stats['course_count'] ?? 0 ?></span>
                    </div>
                    <div class="stat-box">
                        <i class="fas fa-award"></i>
                        <span class="stat-label">Credits</span>
                        <span class="stat-value"><?= $stats['total_credits'] ?? 0 ?>/18</span>
                    </div>
                    <div class="stat-box">
                        <i class="fas fa-calendar-check"></i>
                        <span class="stat-label">Joined</span>
                        <span class="stat-value"><?= date('M Y', strtotime($user['created_at'])) ?></span>
                    </div>
                </div>

                <div class="info-group">
                    <div class="info-row">
                        <span style="font-weight:600; color:#64748b;">Email Address</span>
                        <span><?= htmlspecialchars($user['email']) ?></span>
                    </div>
                    
                    <form action="" method="post" enctype="multipart/form-data" class="file-input-wrapper">
                        <label style="display:block; margin-bottom:10px; font-weight:600;">Profile Picture</label>
                        <label for="img-upload" class="custom-file-label">
                            <i class="fas fa-image"></i> Choose New Photo
                        </label>
                        <input type="file" id="img-upload" name="profile_image" style="display:none;" onchange="document.getElementById('file-name').textContent = this.files[0].name">
                        <div id="file-name" style="font-size:0.8rem; color:var(--primary); margin-top:5px;"></div>
                        
                        <button type="submit" name="update_profile" class="btn-save">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
