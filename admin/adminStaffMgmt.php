<script>
  var pageTitle = "IT Staff Management";
</script>

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
$sql = "SELECT u.*, r.RoleName, b.BranchName,
               (SELECT MAX(al.activity_time)
                FROM t_activitylogs al
                WHERE al.UserId = u.UserId) AS last_activity
        FROM t_users u
        JOIN t_roles r ON u.RoleId = r.RoleId
        JOIN t_branch b ON u.BranchId = b.BranchId
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
    header("Location: ../admin/adminStaffMgmt.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCPL STS - Staff Management</title>
    <link rel="icon" type="image/x-icon" href="../asset/img/qcpl-sts-logo.png">

    <!-- External CSS Link/s -->
    <link rel ="stylesheet" href="../asset/css/sidebar.css">
    <link rel="stylesheet" href="../asset/css/div_mods.css">
    <link rel="stylesheet" href="../asset/css/tbl_charts.css">
    <link rel="stylesheet" href="../asset/css/tbl-controls.css">
    <link rel="stylesheet" href="../asset/css/buttons.css">
    <link rel ="stylesheet" href="../asset/css/pagination.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="layout-container d-flex">
        <!-- Sidebar and Header -->
        <?php include '../admin/inc/sidebar.php'; ?>

        <!-- Wrapper for Header + Main -->
        <div class="main-wrapper w-100" style="margin-left: 80px; margin-top: 30px;">
        <!-- Main Content -->
        <main class="px-4 py-5">
            <div class="col-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mt-2">
                    <!-- Left: Add New Staff Button -->
                    <div style="flex: 0 0 auto;">
                        <div class="div-mods active" data-bs-toggle="modal" data-bs-target="#registerITModal">
                            <span class="mods">Register an IT Staff</span>
                        </div>
                    </div>

                    <!-- Right: Table Controls -->
                    <div class="d-flex flex-wrap align-items-center gap-3" style="flex: 1 1 auto; justify-content: flex-end;">
                        
                    <!-- Search Bar -->
                    <div class="input-group" style="max-width: 380px;">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="search-icon">

                    <span class="input-group-text control-btn" id="search-icon">
                        <i class="fa fa-search"></i>
                    </span>
                    </div>
                    
                    <!-- Sort Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle control-btn" type="button" data-bs-toggle="dropdown">
                            <i class="fa fa-sort me-1"></i>
                        </button>
                        <ul class="dropdown-menu shadow-sm p-2 rounded-3 border-0">
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-sort-alpha-up me-2"></i>Ascending</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-sort-alpha-down me-2"></i>Descending</a></li>
                        </ul>
                    </div>
                    </div>
                </div>
                </div>

        <!-- Table for displaying staff -->
            <div class="row no-gutters mt-3">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="staffTable" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="width:2%">IT ID</th>
                                        <th style="width:2%">First Name</th>
                                        <th style="width:2%">Last Name</th>
                                        <th style="width:2%">Email</th>
                                        <th style="width:2%">Contact No.</th>
                                        <th style="width:2%">Branch</th>
                                        <!--th>Role</!--th>-->
                                        <th style="width:2%">Status</th>
                                        <th style="width:2%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user) : ?>
                                        <tr>
                                            <td><?php echo $user['UserId']; ?></td>
                                            <td><?php echo $user['FirstName']; ?></td>
                                            <td><?php echo $user['LastName']; ?></td>
                                            <td><?php echo $user['Email']; ?></td>
                                            <td><?php echo $user['Contactno']; ?></td>
                                            <td><?php echo $user['BranchName']; ?></td>
                                            <!--td><?php echo $user['RoleName']; ?></!--td>-->
                                            <td>
                                            <span class="<?= $user['status'] === 'Online' ? 'text-success' : 'text-muted' ?>">
                                                <?= $user['status'] ?>
                                            </span>
                                            </td>
                                            <td>
                                            <!-- Edit Button -->
                                            <button 
                                                class="btn btn-edit btn-sm" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editModal<?php echo $user['UserId']; ?>">
                                                Edit
                                            </button>
                                            <div class="modal fade" id="editModal<?php echo $user['UserId']; ?>" tabindex="-1">
                                            <!-- Update IT Modal -->
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                <form method="POST" action="../modals/adminUpdateIT.php">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title">Edit IT Staff</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <input type="hidden" name="id" value="<?php echo $user['UserId']; ?>">
                                                    <label>First Name:</label>
                                                    <input type="text" name="first_name" class="form-control" value="<?php echo $user['FirstName']; ?>" required>
                                                    <label>Last Name:</label>
                                                    <input type="text" name="last_name" class="form-control" value="<?php echo $user['LastName']; ?>" required>
                                                    <label>Email:</label>
                                                    <input type="email" name="email" class="form-control" value="<?php echo $user['Email']; ?>" required>
                                                    <label>Contact No:</label>
                                                    <input type="text" name="contactno" class="form-control" value="<?php echo $user['Contactno']; ?>" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                            </div>

                                            <!-- Delete Button -->
                                            <button class="btn btn-danger btn-sm" onclick="openDeleteModal(<?php echo $user['UserId']; ?>)">Delete</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </main>
        </div>
    </div>
    
    <!-- Register IT Staff Modal -->
    <?php include '../modals/adminRegisterIT.php'; ?>
    <!-- Update IT Staff Modal -->
    <?php include '../modals/adminUpdateIT.php'; ?>
    <!-- Delete IT Staff Modal -->
    <?php include '../modals/adminDeleteIT.php'; ?>

    <!-- External JS Files -->
    <script src="../asset/js/sidebar.js"></script>
    <script src="../asset/js/adminfetchModal.js"></script>
    
    <script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#staffTable tbody tr');

        rows.forEach(row => {
        const cells = Array.from(row.getElementsByTagName('td'));
        const match = cells.some(cell => cell.textContent.toLowerCase().includes(filter));
        row.style.display = match ? '' : 'none';
        });
    });
    </script>
</body>
</html>