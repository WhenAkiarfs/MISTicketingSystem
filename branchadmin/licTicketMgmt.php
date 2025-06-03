<script>
    var pageTitle = "Ticket Management";
</script>

<?php

include '../Includes/config.php';
include '../Includes/check_session.php';
if ($_SESSION['RoleId'] != 2) {
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
    <link rel="stylesheet" href="../asset/css/notif.css">
    <link rel="stylesheet" href="../asset/css/div_mods.css">
    <link rel="stylesheet" href="../asset/css/navtabs.css">
    <link rel="stylesheet" href="../asset/css/tbl_charts.css">
    <link rel="stylesheet" href="../asset/css/tbl-controls.css">
    <link rel="stylesheet" href="../asset/css/buttons.css">    
    <link rel ="stylesheet" href="../asset/css/pagination.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- External JS Link/s -->
    <script src="../asset/js/adminNavTables.js"></script>
    <script src="../asset/js/sidebar.js"></script>
    <script src="../asset/js/notif.js"></script>
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
                        <div class="div-mods active" onclick="window.location.href='licTicketMgmt.php'">
                            <span class="mods">Repair Requests</span>
                        </div>
                        <div class="div-mods inactive" onclick="window.location.href='licCompletedTickets.php'">
                            <span class="mods">Completed Tickets</span>
                        </div>
                        <div class="div-mods inactive" onclick="window.location.href='licArchivedTickets.php'">
                            <span class="mods">Ticket History Archive</span>
                        </div>
                    </div>

                    <!-- Controls Section -->
                    <div class="d-flex flex-wrap flex-lg-nowrap align-items-center gap-2">
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
                                <i class="fa fa-filter me-1"></i>
                            </button>
                            <ul class="dropdown-menu shadow-sm p-2 rounded-3 border-0">
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-gear me-2"></i>Type of Issue</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-user-circle me-2"></i>IT Technician</a></li>
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

            <div class="row no-gutters mt-4">
            <!-- Tabs Header + Submit Button Container -->
            <div class="d-flex justify-content-between align-items-center mb-1 w-100">
                
                <!-- Tabs -->
                <ul class="nav nav-tabs mt-2" id="nav-tix" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pending-tab" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="ongoing-tab" data-bs-toggle="tab" href="#ongoing" role="tab" aria-controls="ongoing" aria-selected="false">On Going</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="alltix-tab" data-bs-toggle="tab" href="#alltix" role="tab" aria-controls="alltix" aria-selected="false">All Tickets</a>
                    </li>
                </ul>

                <!-- Submit Ticket Button -->
                <button type="button" class="btn btn-submit ms-3" data-bs-toggle="modal" data-bs-target="#submitTicketModal">
                    Submit a Ticket
                </button>
            </div>
        </div>

            <!-- All Repair Tickets Submitted Table -->
            <!-- Tabs Content -->
            <div class="tab-content" id="nav-tix-content">
                <!-- Pending Tab Pane -->
                <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                    <table class="table table-striped table-hover mt-3" id="tblRepairTickets">
                        <thead class="thead-dark">
                        <tr>
                                <th style="width: 4%;">Submitted At</th>
                                <th style="width: 3%;">Ticket ID</th>
                                <th style="width: 3%;">Asset</th>
                                <th style="width: 3%;">Type of Issue</th>
                                <th style="width: 6%;">Description</th>
                                <th style="width: 5%;">IT Technician</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Apr 12, 2025, 09:43:15</td>
                                <td>1001</td>
                                <td>Monitor</td>
                                <td>Hardware</td>
                                <td>Monitor is not turning on</td>
                                <td>John Doe</td>
                            </tr>
                            <!-- Rows will be populated by here -->
                        </tbody>
                    </table>
                </div>

                <!-- Ongoing Tab Pane -->
                <div class="tab-pane fade" id="ongoing" role="tabpanel" aria-labelledby="ongoing-tab">
                    <table class="table table-md table-bordered table-striped table-hover mt-3">
                        <thead class="thead-dark">
                        <tr>
                                <th style="width: 4%;">Submitted At</th>
                                <th style="width: 3%;">Ticket ID</th>
                                <th style="width: 3%;">Asset</th>
                                <th style="width: 3%;">Type of Issue</th>
                                <th style="width: 6%;">Description</th>
                                <th style="width: 5%;">IT Technician</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Apr 12, 2025, 09:43:15</td>
                                <td>1002</td>
                                <td>Monitor</td>
                                <td>Hardware</td>
                                <td>Monitor is not turning on</td>
                                <td>John Doe</td>
                            </tr>
                            <!-- Rows will be populated by here -->
                        </tbody>
                    </table>
                </div>

                <!-- All Tickets Tab Pane -->
                <div class="tab-pane fade" id="alltix" role="tabpanel" aria-labelledby="alltix-tab">
                    <table class="table table-md table-bordered table-striped table-hover mt-3">
                        <thead class="thead-dark">
                            <tr>
                                <th class="dateTime" style="width: 5%">Submitted At</th>
                                <th class="tixId" style="width: 4%">Ticket ID</th>
                                <th class="branch" style="width: 4%">Asset</th>
                                <th class="issue" style="width: 4%">Type of Issue</th>
                                <th class="description" style="width: 6%">Description</th>
                                <th class="assignedIT" style="width: 5%">Assigned IT</th>
                                <th class="status" style="width: 5%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                                <td>Apr 12, 2025, 09:43:15</td>
                                <td>1001</td>
                                <td>Monitor</td>
                                <td>Hardware</td>
                                <td>Monitor is not turning on</td>
                                <td>John Doe</td>
                                <td><button type="button" class="btn btn-pending">Pending</button></td>
                            </tr>
                            <tr>
                                <td>Apr 12, 2025, 09:43:15</td>
                                <td>1002</td>
                                <td>Monitor</td>
                                <td>Hardware</td>
                                <td>Monitor is not turning on</td>
                                <td>Johann Doe</td>
                                <td>
                                <button type="button" class="btn btn-ongoing" id="tixStatus">On Going</button>
                                </td>
                                </tr>
                            <tr>
                                <td>Apr 12, 2025, 09:43:15</td>
                                <td>1003</td>
                                <td>Monitor</td>
                                <td>Hardware</td>
                                <td>Monitor is not turning on</td>
                                <td>Jane Smith</td>
                                <td>
                                <button type="button" class="btn btn-completed" id="tixStatus">Completed</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Apr 12, 2025, 09:43:15</td>
                                <td>1004</td>
                                <td>Monitor</td>
                                <td>Hardware</td>
                                <td>Monitor is not turning on</td>
                                <td>Janna Adams</td>
                                <td>
                                <button type="button" class="btn btn-cancelled" id="tixStatus">Cancelled</button>
                                </td>
                            </tr>
                            <!-- Rows will be populated by here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </main>
        </div>
    </div>
    <!-- Submit Ticket Modal -->
    <?php include '../modals/submitTicket.php'; ?>
    <!-- View Ticket Modal -->
    <?php include '../modals/viewTicketInfo.php'; ?>
</body>
</html>