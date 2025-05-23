<?php
session_start();
include '../Includes/config.php';

if (isset($_SESSION['UserId'])) {
    $userId = $_SESSION['UserId'];
    $stmt = $conn->prepare("INSERT INTO t_activitylogs (UserId, activity_type, activity_time) VALUES (:userId, 'Heartbeat', NOW())");
    
    $stmt->execute(['userId' => $userId]);
}

// Show success message if exists
if (isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success_message'] . "</div>";
    unset($_SESSION['success_message']);
}

// Fetch all IT staff with last activity
$sql = "SELECT u.*, r.RoleName,
               (SELECT MAX(al.activity_time)
                FROM t_activitylogs al
                WHERE al.UserId = u.UserId) AS last_activity
        FROM t_users u
        JOIN t_roles r ON u.RoleId = r.RoleId
        WHERE u.RoleId = 3";
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Determine online/offline status
foreach ($users as &$user) {
    $lastActivity = strtotime($user['last_activity']);
    $now = time();
    $user['status'] = ($lastActivity && ($now - $lastActivity) <= 600) ? 'Online' : 'Offline';
}
unset($user); // Break reference

// Handle IT staff update POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];

    $sql = "UPDATE t_users 
            SET FirstName = :firstName, LastName = :lastName, Email = :email, Contactno = :contactno 
            WHERE UserId = :id AND RoleId = 3";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
        'contactno' => $contactno,
        'id' => $id
    ]);

    $_SESSION['success_message'] = "Successfully updated account!";
    header("Location: ../admin/ManageIT.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QCPL STS - Dashboard</title>
    <link rel="icon" type="image/x-icon" href="../asset/img/qcpl-sts-logo.png">
    <link rel="stylesheet" href="../asset/css/admin-sidebar.css">
    <link rel="stylesheet" href="../asset/css/admin-dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        table { width: 100%; margin-top: 20px; border-collapse: collapse; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        table th, table td { padding: 12px; text-align: center; vertical-align: middle; }
        table th { background-color: #343a40; color: white; font-weight: bold; }
        table tbody tr:nth-child(odd) { background-color: #f8f9fa; }
        table tbody tr:nth-child(even) { background-color: #e9ecef; }
        table tbody tr:hover { background-color: #d1d8e0; cursor: pointer; }
        table td a { text-decoration: none; color: #007bff; padding: 5px 10px; border-radius: 4px; }
        table td a:hover { background-color: #0056b3; color: white; }
        .container-fluid { padding: 0 20px; }
        h2 { font-size: 2rem; font-weight: 600; color: #333; }
        .SubNavbar { margin: 20px 0; }
        .SubNavbar a { color: #007bff; text-decoration: none; padding: 8px 15px; background-color: #f8f9fa; border-radius: 4px; margin-right: 10px; }
        .SubNavbar a:hover { background-color: #0056b3; color: white; }
    </style>
</head>
<body>
<div class="layout-container d-flex">
    <?php include '../admin/inc/admin-sidebar.php'; ?>

    <div class="main-wrapper w-100" style="margin-left: 80px; margin-top: 30px;">
        <main class="px-4 py-5">
            <div class="row align-items-stretch" style="margin-left: 260px; padding: 20px;">
                <h2>Welcome Admin, <?php echo $_SESSION['FirstName']; ?>!</h2>
                <p>You are now logged in as Admin.</p>

                <div class="SubNavbar">
                    <ul>
                        <li><a href="../admin/addITstaff.php">Add IT staff</a></li>
                    </ul>
                </div>

                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Contact No.</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $user['UserId']; ?></td>
                                <td><?= $user['FirstName']; ?></td>
                                <td><?= $user['LastName']; ?></td>
                                <td><?= $user['Email']; ?></td>
                                <td><?= $user['Contactno']; ?></td>
                                <td><?= $user['RoleName']; ?></td>
                                <td>
                                    <span class="<?= $user['status'] === 'Online' ? 'text-success' : 'text-muted' ?>">
                                        <?= $user['status'] ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="../admin/updateITacc.php?id=<?= $user['UserId']; ?>">Edit</a>
                                    <a href="deleteITstaff.php?id=<?= $user['UserId']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
</body>
</html>
