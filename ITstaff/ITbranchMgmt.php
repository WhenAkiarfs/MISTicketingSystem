<script>
    var pageTitle = "Branch Management";
</script>

<?php
session_start();
include '../Includes/config.php'; // Ensure this is included at the top

if (isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success_message'] . "</div>";
    unset($_SESSION['success_message']); // Remove the message after displaying
}

//LIC staff table 
$sql = "SELECT * FROM t_users 
        JOIN t_roles ON t_users.RoleId = t_roles.RoleId 
        JOIN t_branch ON t_users.BranchId = t_branch.BranchId
        WHERE t_users.RoleId = 2";

$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

//update LIC staff
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM t_users WHERE UserId = :id and RoleId=2";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];

    $sql = "UPDATE t_users SET FirstName = :firstName, LastName = :lastName, Email = :email, Contactno = :contactno WHERE UserId = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
        'contactno' => $contactno,
        'id' => $id
    ]);

    $_SESSION['success_message'] = "Successfully updated account!";
    header("Location: ../admin/ITbranchMgmt.php ");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCPL STS - Branch Management</title>
    <link rel="icon" type="image/x-icon" href="../asset/img/qcpl-sts-logo.png">

    <!-- External CSS Link/s -->
    <link rel ="stylesheet" href="../asset/css/sidebar.css">
    <link rel="stylesheet" href="../asset/css/div_mods.css">
    <link rel="stylesheet" href="../asset/css/navtabs.css">
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
            <div class="container-fluid branchmgmt-nav">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mt-2">
                    <!-- Tabs Section -->
                    <div class="d-flex flex-wrap gap-2">
                        <div class="div-mods active" onclick="window.location.href='ITbranchMgmt.php'">
                            <span class="mods">Librarian-in-Charge</span>
                        </div>
                        <div class="div-mods inactive" onclick="window.location.href='ITemployeeList.php'">
                            <span class="mods">Employee</span>
                        </div>
                        <div class="div-mods action" data-bs-toggle="modal" data-bs-target="#registerLICModal">
                        <span class="mods">Register an LIC</span>
                        </div>
                    </div>

                    <!-- Controls Section -->
                    <div class="d-flex flex-wrap flex-lg-nowrap align-items-center gap-2">
                        <!-- Search -->
                        <div class="input-group" style="max-width: 280px;">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="search-icon">
                            <span class="input-group-text control-btn"><i class="fa fa-search"></i></span>
                        </div>
                        
                        <!-- Filter Dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle control-btn" type="button" data-bs-toggle="dropdown">
                            <i class="fa fa-filter me-1"></i>
                            </button>
                            <ul class="dropdown-menu shadow-sm p-2 rounded-3 border-0">
                                <li><a class="dropdown-item py-2 px-3" href="#"><i class="fa-solid fa-location-dot me-2"></i>Branch</a></li>
                            </ul>
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

            <!-- Librarian-in-Charge Table -->
            <div class="row no-gutters mt-4">
                <div class="col-12">
                    <div class="table-responsive"> 
                        <table id="licTable" class="table table-striped table-hover" id="tblLIC">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="width:2%">LIC ID</th>
                                    <th style="width:2%">First Name</th>
                                    <th style="width:2%">Last Name</th>
                                    <th style="width:3%">Email</th>
                                    <th style="width:2%">Contact No.</th>
                                    <th style="width:4%">Branch</th>
                                    <!--th>Role</!--th>-->
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
                                            <!-- Edit Button -->
                                            <button 
                                                class="btn btn-edit btn-sm" 
                                                onclick="openEditModal2(<?php echo $user['UserId']; ?>)">
                                                Edit
                                            </button>
                                            <!-- Delete Button -->
                                            <button 
                                                class="btn btn-danger btn-sm" 
                                                onclick="openDeleteModal(<?php echo $user['UserId']; ?>)">
                                                Delete
                                            </button>
                                            </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </main>
    </div>

    <!-- Register LIC Modal -->
    <?php include '../modals/RegisterLIC.php'; ?>
    <!-- Update LIC Modal -->
    <?php include '../modals/UpdateLIC.php'; ?>
    <!-- Delete LIC Modal -->
    <?php include '../modals/confirmationModal.php'; ?>

    <!-- External JS Files -->
    <script src="../asset/js/sidebar.js"></script>
    <script src="../asset/js/fetchModal.js"></script>

    <script>
  document.getElementById('searchInput').addEventListener('keyup', function () {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#licTable tbody tr');

    rows.forEach(row => {
      const cells = Array.from(row.getElementsByTagName('td'));
      const match = cells.some(cell => cell.textContent.toLowerCase().includes(filter));
      row.style.display = match ? '' : 'none';
    });
  });
</script>
</body>
</html>