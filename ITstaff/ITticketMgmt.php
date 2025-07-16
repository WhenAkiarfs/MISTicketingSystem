<script>
    var pageTitle = "Ticket Management";
</script>

<?php

include '../Includes/config.php';
include '../Includes/check_session.php';

//Ticket table 
$sql = "SELECT * FROM t_ticketissues
        JOIN t_tickets ON t_ticketissues.TicketId = t_tickets.TicketId
        JOIN t_branch ON t_tickets.BranchId = t_branch.BranchId
        JOIN t_issuedtype ON t_ticketissues.IssueId = t_issuedtype.IssueId";
$stmt = $conn->prepare(query: $sql);
$stmt->execute();
$tickets =$stmt->fetchAll(mode: PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="../asset/css/notif.css">
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

    <!-- Custom JS Link/s -->
    <script src="../asset/js/adminNavTables.js"></script>
    <script src="../asset/js/sidebar.js"></script>
    <script src="../asset/js/notif.js"></script>
    <script src="../asset/js/pagination.js"></script>
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
                        <div class="div-mods active" onclick="window.location.href='ITticketMgmt.php'">
                            <span class="mods">Repair Requests</span>
                        </div>
                        <div class="div-mods inactive" onclick="window.location.href='ITcompletedTickets.php'">
                            <span class="mods">Completed Tickets</span>
                        </div>
                        <div class="div-mods inactive" onclick="window.location.href='ITarchivedTickets.php'">
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

                        <!-- Filter Dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle control-btn" type="button" data-bs-toggle="dropdown">
                                <i class="fa fa-filter me-1"></i>
                            </button>
                            <ul class="dropdown-menu shadow-sm p-2 rounded-3 border-0">
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-chart-simple me-2"></i>Status</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-location-dot me-2"></i>Type of Issue</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-book-open me-2"></i>Branch</a></li>
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

            <!-- Repair Requests Table -->
            <div class="row no-gutters mt-4">
            <!-- Tabs Header -->
            <div class="d-flex justify-content-between align-items-center mb-1">
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
            </div>

            <!-- Tabs Content -->
            <div class="tab-content" id="nav-tix-content">
            <!-- Pending Tab Pane -->
            <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                <div class="table-responsive mt-0">
                    <table id="pendingTable" class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Ticket ID</th>
                                <th>Submitted At</th>
                                <th>Branch</th>
                                <th>Issue</th>
                                <th>Assigned IT</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tickets as $ticket) : ?>
                                <?php if ($ticket['TicketStatus'] === 'Pending') : ?>
                                    <tr>
                                        <td><?php echo $ticket['TicketId']; ?></td>
                                        <td><?php echo $ticket['TimeSubmitted']; ?></td>
                                        <td><?php echo $ticket['BranchName']; ?></td>
                                        <td><?php echo $ticket['IssueType']; ?></td>
                                        <td><?php echo $ticket['AssignedITstaffId']; ?></td>
                                        <td><?php echo $ticket['TicketStatus']; ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <div class="d-flex justify-content-end align-items-center gap-2 mt-3 pe-4">
                        <div class="custom-pagination" id="pendingTablePagination"></div>

                        <!-- Records per page selector -->
                        <div class="d-flex align-items-center gap-2">
                            <label for="perPageSelect" class="form-label mb-0">Show:</label>
                            <select id="perPageSelect" class="form-select form-select-sm" style="width: 70px;">
                                <option value="5">5</option>
                                <option value="10" selected>10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                            </select>
                            <span id="totalItemCount" class="text-muted">of 0 items</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ongoing Tab Pane -->
            <div class="tab-pane fade" id="ongoing" role="tabpanel" aria-labelledby="ongoing-tab">
                <div class="table-responsive mt-0">
                    <table id="ongoingTable" class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Ticket ID</th>
                                <th>Submitted At</th>
                                <th>Branch</th>
                                <th>Issue</th>
                                <th>Assigned IT</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tickets as $ticket) : ?>
                                <?php if ($ticket['TicketStatus'] === 'Ongoing') : ?>
                                    <tr>
                                        <td><?php echo $ticket['TicketId']; ?></td>
                                        <td><?php echo $ticket['TimeSubmitted']; ?></td>
                                        <td><?php echo $ticket['BranchName']; ?></td>
                                        <td><?php echo $ticket['IssueType']; ?></td>
                                        <td><?php echo $ticket['AssignedITstaffId']; ?></td>
                                        <td><?php echo $ticket['TicketStatus']; ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <div class="d-flex justify-content-end align-items-center gap-2 mt-3 pe-4">
                        <div class="custom-pagination" id="ongoingTablePagination"></div>

                        <!-- Records per page selector -->
                        <div class="d-flex align-items-center gap-2">
                            <label for="perPageSelect" class="form-label mb-0">Show:</label>
                            <select id="perPageSelect" class="form-select form-select-sm" style="width: 70px;">
                                <option value="5">5</option>
                                <option value="10" selected>10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                            </select>
                            <span id="totalItemCount" class="text-muted">of 0 items</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- All Tickets Tab Pane -->
            <div class="tab-pane fade" id="alltix" role="tabpanel" aria-labelledby="alltix-tab">
                <div class="table-responsive mt-0">
                    <table id="alltixTable" class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Ticket ID</th>
                                <th>Submitted At</th>
                                <th>Branch</th>
                                <th>Issue</th>
                                <th>Assigned IT</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Rows will be dynamically added via JavaScript -->
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <div class="d-flex justify-content-end align-items-center gap-2 mt-3 pe-4">
                        <div class="custom-pagination" id="alltixTablePagination"></div>

                        <!-- Records per page selector -->
                        <div class="d-flex align-items-center gap-2">
                            <label for="perPageSelect" class="form-label mb-0">Show:</label>
                            <select id="perPageSelect" class="form-select form-select-sm" style="width: 70px;">
                                <option value="5">5</option>
                                <option value="10" selected>10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                            </select>
                            <span id="totalItemCount" class="text-muted">of 0 items</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- End of Main Content -->
    <!-- View Ticket Modal -->
    <?php include '../modals/viewTicketInfo.php'; ?>

    <!-- Account Profile Update Modal -->
    <?php include '../auth/updateAcc.php'; ?>

    <!-- Account Password Update Modal -->
    <?php include '../auth/updatePass.php'; ?>

    <script>
        paginateTableWithLimitSelector(
        '#pendingTable',
        '#pendingTablePagination',
        'perPageSelect',
        'totalItemCount'
        );

        paginateTableWithLimitSelector(
        '#ongoingTable',
        '#ongoingTablePagination',
        'perPageSelect',
        'totalItemCount'
        );

        paginateTableWithLimitSelector(
        '#alltixTable',
        '#alltixTablePagination',
        'perPageSelect',
        'totalItemCount'
        );
        </script>
</body>
</html>