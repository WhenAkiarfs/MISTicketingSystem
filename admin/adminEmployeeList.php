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

//Employee table 
$sql = "SELECT * FROM t_users 
        JOIN t_branch ON t_users.BranchId = t_branch.BranchId 
        WHERE RoleId=4 " ;
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Show the modal
            var myModal = new bootstrap.Modal(document.getElementById('successfulRegistrationModal'));
            myModal.show();

            // Remove the 'success' parameter from the URL
            const url = new URL(window.location);
            url.searchParams.delete('success');
            window.history.replaceState({}, document.title, url);
        });
    </script>
<?php endif; ?>

<?php if (isset($_GET['success']) && $_GET['success'] == 2): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var myModal = new bootstrap.Modal(document.getElementById('successfulUpdateModal'));
            myModal.show();

            const url = new URL(window.location);
            url.searchParams.delete('success');
            window.history.replaceState({}, document.title, url);
        });
    </script>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCPL STS - Dashboard</title>
    <link rel="icon" type="image/x-icon" href="../asset/img/qcpl-sts-logo.png">

    <!-- External CSS Link/s -->
    <link rel ="stylesheet" href="../asset/css/sidebar.css">
    <link rel="stylesheet" href="../asset/css/div_mods.css">
    <link rel="stylesheet" href="../asset/css/tbl_charts.css">
    <link rel="stylesheet" href="../asset/css/tbl-controls.css">
    <link rel="stylesheet" href="../asset/css/buttons.css">
    <link rel="stylesheet" href="../asset/css/pagination.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- External JS Files -->
    <script src="../asset/js/sidebar.js"></script>
    <script src="../asset/js/fetchModal.js"></script>
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
                        <div class="div-mods inactive" onclick="window.location.href='adminBranchMgmt.php'">
                            <span class="mods">Librarian-in-Charge</span>
                        </div>
                        <div class="div-mods active" onclick="window.location.href='adminEmployeeList.php'">
                            <span class="mods">Employee</span>
                        </div>
                        <div class="div-mods action" data-bs-toggle="modal" data-bs-target="#registerEmpModal">
                        <span class="mods">Register an Employee</span>
                        </div>
                    </div>

                    <!-- Controls Section -->
                    <div class="d-flex flex-wrap flex-lg-nowrap align-items-center gap-2">
                        <!-- Search -->
                        <div class="input-group" style="max-width: 280px;">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="search-icon">
                            <span class="input-group-text control-btn"><i class="fa fa-search"></i></span>
                        </div>

                        <!-- Sort Dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle control-btn" type="button" data-bs-toggle="dropdown">
                                <i class="fa fa-sort me-1"></i> Sort
                            </button>
                            <ul class="dropdown-menu shadow-sm p-2 rounded-3 border-0">
                                <li><a class="dropdown-item" href="#"><i class="fa fa-arrow-down-short-wide me-2"></i>Ascending</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa fa-arrow-up-short-wide me-2"></i>Descending</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Branch Employees Table -->
            <div class="row no-gutters mt-4">
                <div class="col-12">
                    <div class="table-responsive"> 
                        <table id="empTable" class="table table-striped table-bordered table-hover" id="tblEmployee">
                        <thead class="thead-dark">
                            <tr>
                            <th style="width:0.5%">Employee ID</th>
                            <th style="width:1%">First Name</th>
                            <th style="width:2%">Last Name</th>
                            <th style="width:1%">Email</th>
                            <th style="width:0.5%">Contact No.</th>
                            <th style="width:4%">Branch</th>
                            <!--th>Role</!--th>-->
                            <th style="width:1.2%">Actions</th>                        
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
                                    <!--td><?php echo $user['RoleId']; ?></!--td>-->
                                    <td>
                                        <!-- Edit Button -->
                                        <button 
                                            class="btn btn-edit btn-sm" 
                                            onclick="openEditModal3(<?php echo $user['UserId']; ?>)">
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
    <?php include '../modals/RegisterEmployee.php'; ?>
    <?php include '../modals/UpdateEmp.php'; ?>
    <?php include '../modals/confirmationModal.php'; ?>

    <script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#empTable tbody tr');

    rows.forEach(row => {
        const cells = Array.from(row.getElementsByTagName('td'));
        const match = cells.some(cell => cell.textContent.toLowerCase().includes(filter));
        row.style.display = match ? '' : 'none';
    });
    });
    </script>
</body>
</html>