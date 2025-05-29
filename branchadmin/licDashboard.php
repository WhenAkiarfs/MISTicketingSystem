<script>
    var pageTitle = "Dashboard";
</script>

<?php

include '../Includes/config.php';
include '../Includes/check_session.php';

if ($_SESSION['RoleId'] != 2) {
    header('Location: ../auth/login_error.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCPL STS - Dashboard</title>
    <link rel="icon" type="image/x-icon" href="../asset/img/qcpl-sts-logo.png">

    <!-- External CSS Link/s -->
    <link rel ="stylesheet" href="../asset/css/sidebar.css">
    <link rel="stylesheet" href="../asset/css/greeting.css">
    <link rel="stylesheet" href="../asset/css/ticket-cards.css">
    <link rel="stylesheet" href="../asset/css/navtabs.css">
    <link rel="stylesheet" href="../asset/css/tbl_charts.css">
    <link rel="stylesheet" href="../asset/css/tbl-controls.css">
    <link rel="stylesheet" href="../asset/css/buttons.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- External JS Link/s -->
    <script src="../asset/js/sidebar.js"></script>
    <script src="../asset/js/greetingCard.js"></script>
    <script src="../asset/js/recentTicket.js"></script>
    <script src="../asset/js/ticketSummary.js"></script>
    <script src="../asset/js/adminNavTables.js"></script>
</head>

<body>
    <div class="layout-container d-flex">
        <!-- Sidebar and Header -->
        <?php include '../admin/inc/sidebar.php'; ?>

        <!-- Wrapper for Header + Main -->
        <div class="main-wrapper w-100" style="margin-left: 80px; margin-top: 30px;">
            <!-- Main Content -->
            <main class="px-4 py-5">
                <div class="row no-gutters mt-1 align-items-center">
                    <!-- Welcome Card -->
                    <div class="col-md-6 mb-3">
                        <div class="welcome-card">
                            <div class="card-content">
                                <h3 id="greeting"></h3>
                                <h1 class="fw-bold"><?php echo $_SESSION['FirstName']; ?></h1>
                                <div class="location-tag">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span id="location">Quezon City, Philippines</span>
                                </div>
                            </div>
                            <img src="../asset/img/dashboard-welcome-card.png" alt="QCPL STS Welcome Card" class="card-image">
                        </div>
                    </div>

                    <!-- Recent Ticket Card -->
                    <div class="col-md-4 mb-3">
                        <div class="ticket-container">
                            <div class="ticket-header">
                                <h5 class= "fw-bold text-center" id="ticket-title">RECENT TICKET</h5>
                            </div>
                            
                            <div class="ticket-body">
                            <div class="ticket-grid">
                                <div>Ticket ID<br><span id="ticket-id">000001</span></div>
                                <div>Status<br><span id="ticket-status">Pending</span></div>
                            </div>
                            <div class="ticket-grid">
                                <div>Branch<br><span id="ticket-branch">Cubao</span></div>
                                <div>Issue<br><span id="ticket-issue">Monitor Replacement</span></div>
                            </div>

                            <div class="ticket-grid">
                                <div>Date<br><span id="ticket-date">April 23, 2025</span></div>
                                <div>Time<br><span id="ticket-time">11:04:16</span></div>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- Live Date and Time Card -->
                    <div class="col-md-2 mb-3">
                        <div class="live-card text-center">
                            <h6 class="fw-semibold text-muted mb-2"><i class="fa-solid fa-calendar"></i><br>Today is</h6>
                            <h5 id="live-date-line1" class="fw-bold"></h5>
                            <h5 id="live-date-line2" class="fw-bold"></h5>
                            <hr class="my-3">
                            <h6 class="fw-semibold text-muted mb-2"><i class="fa-solid fa-clock"></i><br>Right now, it's</h6>
                            <h1 id="live-time" class="fw-bold" style="font-size: 34px;"></h1>
                        </div>
                    </div>
                </div>
                
                <!-- Ticket Summary Cards -->
                <div class="row no-gutters mt-3 align-items-center">
                    <h3 class="fw-bold mb-3" id="ticket-summary-title">Ticket Summary</h3>

                    <!-- Pending -->
                    <div class="col-md-3 mb-3">
                        <div class="ticket-card pending h-100">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <h5>Pending</h5>
                        <p class="ticket-count">12</p>
                        </div>
                    </div>

                    <!-- On Going -->
                    <div class="col-md-3 mb-3">
                        <div class="ticket-card ongoing h-100">
                        <i class="fa-solid fa-sync-alt fa-spin"></i>
                        <h5>On Going</h5>
                        <p class="ticket-count">8</p>
                        </div>
                    </div>

                    <!-- Completed -->
                    <div class="col-md-3 mb-3">
                        <div class="ticket-card completed h-100">
                        <i class="fa-solid fa-circle-check"></i>
                        <h5>Completed</h5>
                        <p class="ticket-count">25</p>
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="col-md-3 mb-3">
                        <div class="ticket-card total h-100">
                        <i class="fa-solid fa-clipboard"></i>
                        <h5>Total</h5>
                        <p class="ticket-count">41</p>
                        </div>
                    </div>

                        <!-- Tabs for Ticket Summary -->
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <ul class="nav nav-tabs mt-2" id="nav-tix" role="tablist">
                                <li class="nav-item">
                                <a class="nav-link active" id="pending-tab" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" id="ongoing-tab" data-bs-toggle="tab" href="#ongoing" role="tab" aria-controls="ongoing" aria-selected="false">On Going</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" id="completed-tab" data-bs-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="false">Completed</a>
                                </li>
                            </ul>
                            
                            <!-- View All Tickets Link -->
                            <p class="view m-0">
                                <a href="licTicketMgmt.php">View All Tickets <i class="fa-solid fa-chevron-right"></i></a>
                            </p>
                        </div>

                        <!-- Tab Content Container -->
                        <div class="tab-content" id="nav-tix-content">
                            <!-- Pending Tab -->
                            <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                                <table class="table table-md table-bordered table-striped table-hover">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th class="dateTime"style="width: 5%">Submitted At</th>
                                        <th class="tixId" style="width: 4%">Ticket ID</th>
                                        <th class="branch"style="width: 7%">Branch</th>
                                        <th class="issue"style="width: 7%">Issue</th>
                                        <th class="assignedIT"style="width: 5%">Assigned IT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Rows will be populated here -->
                                </tbody>
                            </table>
                        </div>

                        <!-- On Going Tab -->
                        <div class="tab-pane fade" id="ongoing" role="tabpanel" aria-labelledby="ongoing-tab">
                            <table class="table table-md table-bordered table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="dateTime"style="width: 5%">Submitted At</th>
                                        <th class="tixId" style="width: 4%">Ticket ID</th>
                                        <th class="branch"style="width: 7%">Branch</th>
                                        <th class="issue"style="width: 7%">Issue</th>
                                        <th class="assignedIT"style="width: 5%">Assigned IT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Rows will be populated here -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Completed Tab -->
                        <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                            <table class="table table-md table-bordered table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="dateTime"style="width: 5%">Submitted At</th>
                                        <th class="tixId" style="width: 4%">Ticket ID</th>
                                        <th class="branch"style="width: 7%">Branch</th>
                                        <th class="issue"style="width: 7%">Issue</th>
                                        <th class="assignedIT"style="width: 5%">Assigned IT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Rows will be populated here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
        </div>
        </main>
        </div>
    </div>
</body>
</html>

