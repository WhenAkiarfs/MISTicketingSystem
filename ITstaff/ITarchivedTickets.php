<script>
    var pageTitle = "Ticket Management";
</script>

<?php

include '../Includes/config.php';
include '../Includes/check_session.php';
if ($_SESSION['RoleId'] != 3) {
    header('Location: ../employee/home.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCPL STS - Ticket Management</title>
    <link rel="icon" type="image/x-icon" href="../asset/img/qcpl-sts-logo.png">

    <!-- External CSS Link/s -->
    <link rel ="stylesheet" href="../asset/css/sidebar.css">
    <link rel="stylesheet" href="../asset/css/div_mods.css">
    <link rel="stylesheet" href="../asset/css/navtabs.css">
    <link rel="stylesheet" href="../asset/css/tbl_charts.css">
    <link rel="stylesheet" href="../asset/css/tbl-controls.css">
    <link rel="stylesheet" href="../asset/css/buttons.css">    <link rel ="stylesheet" href="../asset/css/pagination.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Chart.js CDN Link -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom JS Link/s -->
    <script src="../asset/js/adminNavTables.js"></script>
    <script src="../asset/js/adminCharts.js"></script>
    <script src="../asset/js/sidebar.js"></script>
    <script src="../asset/js/adminAllTickets.js"></script>
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
                <div class="container-fluid tixmgmt-nav">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mt-2">
                    <!-- Tabs Section -->
                    <div class="d-flex flex-wrap gap-2">
                        <div class="div-mods inactive" onclick="window.location.href='ITticketMgmt.php'">
                            <span class="mods">Repair Requests</span>
                        </div>
                        <div class="div-mods inactive" onclick="window.location.href='ITcompletedTickets.php'">
                            <span class="mods">Completed Tickets</span>
                        </div>
                        <div class="div-mods active" onclick="window.location.href='ITarchivedTickets.php'">
                            <span class="mods">Ticket History Archive</span>
                        </div>
                    </div>

                    <!-- Controls Section -->
                    <div class="d-flex flex-wrap flex-lg-nowrap align-items-center gap-2 controls-container">
                        <!-- Search -->
                        <div class="input-group" style="max-width: 280px;">
                            <input type="text" class="form-control" placeholder="Search" aria-label="Search">
                            <span class="input-group-text control-btn"><i class="fa fa-search"></i></span>
                        </div>

                        <!-- Date Button -->
                        <button class="btn btn-outline-secondary control-btn" type="button">
                            <i class="fa fa-calendar me-1"></i> Select Date
                        </button>

                        <!-- Filter Dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle control-btn" type="button" data-bs-toggle="dropdown">
                                <i class="fa fa-filter me-1"></i> Filter
                            </button>
                            <ul class="dropdown-menu shadow-sm p-2 rounded-3 border-0">
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-toolbox me-2"></i>Type of Issue</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-book-open me-2"></i>Branch</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-user me-2"></i>IT Technician</a></li>
                            </ul>
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

        <!-- Ticket History Archive Table -->
            <div class="row no-gutters mt-4">
                <div class="col-12">
                    <div class="table-responsive mt-0">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Ticket ID</th>
                                    <th>Submitted At</th>
                                    <th>Branch</th>
                                    <th>Issue</th>
                                    <th>Assigned IT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Rows will be dynamically added via JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
            </div>
        </div>
    </div>
</body>
</html>