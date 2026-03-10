<?php
// register-course.php

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$user_id   = $_SESSION['user_id'];
$course_id = $_POST['course_id'] ?? null;
$message   = '';
$type      = 'error'; // for styling: success or error

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($course_id)) {
    // 1. Check if course exists and is active
    $stmt = $conn->prepare("SELECT id, credit_hours, is_active FROM courses WHERE id = ?");
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $message = "Course not found.";
    } else {
        $course = $result->fetch_assoc();
        
        if ($course['is_active'] != 1) {
            $message = "This course is not currently available for registration.";
        } else {
            // 2. Check if already registered
            $check = $conn->prepare("SELECT id FROM registrations WHERE user_id = ? AND course_id = ?");
            $check->bind_param("ii", $user_id, $course_id);
            $check->execute();
            $check->store_result();

            if ($check->num_rows > 0) {
                $message = "You have already registered for this course.";
            } else {
                // 3. (Optional) Check credit limit
                // Get current registered credits
                $credit_query = $conn->prepare("
                    SELECT SUM(c.credit_hours) as total_credits
                    FROM registrations r
                    JOIN courses c ON r.course_id = c.id
                    WHERE r.user_id = ? AND r.status = 'approved'
                ");
                $credit_query->bind_param("i", $user_id);
                $credit_query->execute();
                $credits_result = $credit_query->get_result();
                $current_credits = $credits_result->fetch_assoc()['total_credits'] ?? 0;

                $max_credits = 18; // ← change this to your university's limit
                $new_total   = $current_credits + $course['credit_hours'];

                if ($new_total > $max_credits) {
                    $message = "Registration would exceed maximum credits ($max_credits). Current: $current_credits, This course: {$course['credit_hours']}.";
                } else {
                    // 4. Register the course
                    $insert = $conn->prepare("
                        INSERT INTO registrations (user_id, course_id, status)
                        VALUES (?, ?, 'approved')
                    ");
                    $insert->bind_param("ii", $user_id, $course_id);

                    if ($insert->execute()) {
                        $type    = 'success';
                        $message = "Successfully registered for the course!";
                    } else {
                        $message = "Failed to register: " . $conn->error;
                    }
                    $insert->close();
                }
            }
            $check->close();
        }
    }
    $stmt->close();
} else {
    $message = "Invalid request.";
}

$conn->close();

// Redirect back with message (using session flash message)
$_SESSION['reg_message']  = $message;
$_SESSION['reg_type']     = $type;

header("Location: available-courses.php");
exit();
?>