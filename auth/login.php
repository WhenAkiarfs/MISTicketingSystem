<?php
session_start();
include '../Includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user details
    $sql = "SELECT * FROM t_users WHERE Email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if user exists and password matches
    if ($user && password_verify($password, $user['Password'])) {
        $_SESSION['UserId'] = $user['UserId'];
        $_SESSION['RoleId'] = $user['RoleId'];
        $_SESSION['FirstName'] = $user['FirstName'];

        // Insert login activity
        $logSql = "INSERT INTO t_activitylogs (UserId, activity_type) VALUES (:UserId, 'login')";
        $logStmt = $conn->prepare($logSql);
        $logStmt->execute(['UserId' => $user['UserId']]);

        // Redirect based on role
        if ($user['RoleId'] == 1) {
            header('Location: ../admin/admindashboard.php');
            exit();
        } elseif ($user['RoleId'] == 2) {
            header('Location: ../branchadmin/licDashboard.php');
            exit();
        } elseif ($user['RoleId'] == 3) {
            header('Location: ../ITstaff/ITdashboard.php');
            exit();
        } elseif ($user['RoleId'] == 4) {
            header('Location: ../employee/home.php');
            exit();
        }
    } else {
        $_SESSION['login_error'] = "You have entered an invalid email or password. Please try again.";
        header("Location: ../index.php"); // Send back to form
        exit();
    }
}
?>