<?php
include '../Includes/config.php';
session_start(); // Make sure session is started if using $_SESSION

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateUserId'])) {
    $id = $_POST['updateUserId'];

    // Step 1: Get the role of the user before updating
    $stmt = $conn->prepare("SELECT Role FROM t_users WHERE UserId = :id");
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $role = $user['Role'];

        // Step 2: Update from role-specific tables
        $roleTables = ['t_admin', 't_branchadmin', 't_itstaff', 't_useremp'];
        foreach ($roleTables as $table) {
            $sql = "UPDATE FROM $table WHERE UserId = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute(['id' => $id]);
        }

        // Step 3: Delete from t_users
        $sql = "UPDATE FROM t_users WHERE UserId = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        $_SESSION['update_success'] = true;

        // Step 4: Redirect based on role
        switch ($role) {
            case 2:
                header("Location: licDashboard.php");
                break;
            case 3:
                header("Location: ITdashboard.php");
                break;
            case 4:
                header("Location: home.php");
                break;
            default:
                header("Location: admindashboard.php"); // fallback
                break;
        }
        exit();
    } else {
        // Handle if user does not exist
        $_SESSION['update_error'] = "User not found.";
        header("Location: admindashboard.php");
        exit();
    }
}
?>

<link rel="stylesheet" href="../asset/css/modals.css">

