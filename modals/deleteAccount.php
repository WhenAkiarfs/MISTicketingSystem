<?php
include '../Includes/config.php';
session_start(); // Make sure session is started if using $_SESSION

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteUserId'])) {
    $id = $_POST['deleteUserId'];

    // Step 1: Get the role of the user before deleting
    $stmt = $conn->prepare("SELECT Role FROM t_users WHERE UserId = :id");
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $role = $user['Role'];

        // Step 2: Delete from role-specific tables
        $roleTables = ['t_admin', 't_branchadmin', 't_itstaff', 't_useremp'];
        foreach ($roleTables as $table) {
            $sql = "DELETE FROM $table WHERE UserId = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute(['id' => $id]);
        }

        // Step 3: Delete from t_users
        $sql = "DELETE FROM t_users WHERE UserId = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        $_SESSION['deletion_success'] = true;

        // Step 4: Redirect based on role
        switch ($role) {
            case 2:
                header("Location: adminBranchMgmt.php");
                break;
            case 3:
                header("Location: adminStaffMgmt.php");
                break;
            case 4:
                header("Location: adminEmployeeList.php");
                break;
            default:
                header("Location: admindashboard.php"); // fallback
                break;
        }
        exit();
    } else {
        // Handle if user does not exist
        $_SESSION['deletion_error'] = "User not found.";
        header("Location: admindashboard.php");
        exit();
    }
}
?>
<!--?php
include '../Includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteUserId'])) {
    $id = $_POST['deleteUserId'];

    // Delete from role-specific tables
    $roleTables = ['t_admin', 't_branchadmin', 't_itstaff', 't_useremp'];
    foreach ($roleTables as $table) {
        $sql = "DELETE FROM $table WHERE UserId = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    // Delete from t_users
    $sql = "DELETE FROM t_users WHERE UserId = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);

    $_SESSION['deletion_success'] = true;
    header("Location: ../admin/adminBranchMgmt.php"); // not ../admin/ if already in /admin
    exit();
}
?>-->

<!--?php
include '../Includes/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete from role-specific tables first
    $roleTables = ['t_admin', 't_branchadmin', 't_itstaff', 't_useremp'];
    foreach ($roleTables as $table) {
        $sql = "DELETE FROM $table WHERE UserId = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    // Delete from t_users
    $sql = "DELETE FROM t_users WHERE UserId = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);

    $_SESSION['success_message'] = "Successfully deleted account!";
    header("Location: ../admin/ManageBranch.php");
    exit();
}
?>-->