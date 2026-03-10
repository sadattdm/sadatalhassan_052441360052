<?php
// login.php

session_start(); // Must be at the very top

include 'db.php'; // your connection file

$errors = [];
$success = '';

if (isset($_POST['login'])) {
    $username_or_email = trim($_POST['username'] ?? '');
    $password          = $_POST['password'] ?? '';

    if (empty($username_or_email)) $errors[] = "Username or Email is required.";
    if (empty($password))          $errors[] = "Password is required.";

    if (empty($errors)) {
        // Check if input is email or username
        $field = filter_var($username_or_email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $stmt = $conn->prepare("SELECT id, full_name, username, email, password, profile_image 
                                FROM users 
                                WHERE $field = ?");
        $stmt->bind_param("s", $username_or_email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $user['password'])) {
                // Login successful → store in session
                $_SESSION['user_id']       = $user['id'];
                $_SESSION['full_name']     = $user['full_name'];
                $_SESSION['username']      = $user['username'];
                $_SESSION['profile_image'] = $user['profile_image'];
                $_SESSION['logged_in']     = true;

                // Redirect to dashboard
                header("Location: dashboard.php");
                exit();
            } else {
                $errors[] = "Incorrect password.";
            }
        } else {
            $errors[] = "No account found with that username or email.";
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CourseLink</title>
    <link rel="stylesheet" href="./styles/base.css">
    <link rel="stylesheet" href="./styles/login.css">
    <link rel="stylesheet" href="./styles/register.css">
</head>
<body>

    <main class="auth-page">
        <div class="blob"></div>
        
        <section class="form-section">
            <div class="form-wrapper login-box">
                <div class="form-header">
                    <a href="index.php" class="back-link">← Back to Home</a>
                    <h2>Welcome Back 👋</h2>
                    <p>Enter your credentials to access your portal.</p>
                </div>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $err): ?>
                            <p style="margin: 0.4rem 0;">• <?= htmlspecialchars($err) ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form action="" method="post" class="login-form">
                    <div class="form-group">
                        <label for="username">Username or Email</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username or email" required
                               value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <div class="label-row">
                            <label for="password">Password</label>
                            <a href="#" class="forgot-pass">Forgot?</a>
                        </div>
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                    </div>

                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Keep me logged in</label>
                    </div>

                    <button type="submit" name="login" class="btn">Sign In</button>
                </form>

                <div class="form-footer">
                    <p>New to CourseLink? <a href="register.php">Create an account</a></p>
                </div>
            </div>
        </section>
    </main>

</body>
</html>