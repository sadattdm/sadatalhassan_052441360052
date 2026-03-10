<?php
// register.php

session_start(); // We need sessions for messages & later for login

include 'db.php'; // your connection file

$errors = [];
$success = '';

if (isset($_POST['register'])) {
    $full_name    = trim($_POST['full_name'] ?? '');
    $email        = trim($_POST['email'] ?? '');
    $username     = trim($_POST['username'] ?? '');
    $password     = $_POST['password'] ?? '';
    $confirm_pass = $_POST['confirm_password'] ?? '';

    // Basic validation
    if (empty($full_name))    $errors[] = "Full name is required.";
    if (empty($email))        $errors[] = "Email is required.";
    if (empty($username))     $errors[] = "Username is required.";
    if (empty($password))     $errors[] = "Password is required.";
    if ($password !== $confirm_pass) $errors[] = "Passwords do not match.";

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Check if username or email already exists
    $check = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $check->bind_param("ss", $username, $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $errors[] = "Username or email already taken.";
    }
    $check->close();

    // Profile picture handling
    $profile_image = null;
    if (!empty($_FILES['profile_image']['name'])) {
        $target_dir    = "uploads/profile/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0755, true);

        $file_name     = time() . "_" . basename($_FILES["profile_image"]["name"]);
        $target_file   = $target_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allow only images
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed)) {
            $errors[] = "Only JPG, JPEG, PNG & GIF files are allowed.";
        }

        // Size limit ~2MB
        if ($_FILES["profile_image"]["size"] > 2000000) {
            $errors[] = "Image is too large (max 2MB).";
        }

        if (empty($errors)) {
            if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
                $profile_image = $target_file;
            } else {
                $errors[] = "Failed to upload image.";
            }
        }
    }

    // If no errors → register
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare(
            "INSERT INTO users (full_name, username, email, password, profile_image)
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssss", $full_name, $username, $email, $hashed_password, $profile_image);

        if ($stmt->execute()) {
            $success = "Account created successfully! You can now <a href='login.php'>log in</a>.";
        } else {
            $errors[] = "Something went wrong: " . $conn->error;
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - CourseLink</title>
    <link rel="stylesheet" href="./styles/base.css">
    <link rel="stylesheet" href="./styles/register.css" />
</head>
<body>
    <main class="auth-page">
        <div class="blob"></div>

        <section class="form-section">
            <div class="form-wrapper">
                <div class="form-header">
                    <a href="index.php" class="back-link">← Back to Home</a>
                    <h2>Create Account 🎓</h2>
                    <p>Start your academic journey with CourseLink today.</p>
                </div>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $err): ?>
                            <p style="margin: 0.4rem 0;">• <?= htmlspecialchars($err) ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($success)): ?>
                    <div class="alert alert-success">
                        <?= $success ?>
                    </div>
                <?php endif; ?>

                <form action="" method="post" enctype="multipart/form-data" class="register-form">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" id="full_name" name="full_name" placeholder="John Doe" required
                                   value="<?= htmlspecialchars($_POST['full_name'] ?? '') ?>">
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="john@university.edu" required
                                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" placeholder="johndoe24" required
                                   value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                        </div>

                        <div class="form-group">
                            <label for="profile_image">Profile Picture</label>
                            <div class="file-input-wrapper">
                                <input type="file" id="profile_image" name="profile_image" accept="image/*">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="••••••••" required>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="••••••••" required>
                        </div>
                    </div>

                    <button type="submit" name="register" class="btn">
                        Create Account
                    </button>
                </form>

                <div class="form-footer">
                    <p>Already have an account? <a href="login.php">Login here</a></p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>