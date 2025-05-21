<script>
  var pageTitle = "Dashboard";
</script>

<?php
include '../Includes/check_session.php';
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
            </main>
        </div>
    </div>

    
</body>
</html>

<!--DOCTYPE html>
<html>
<head>
    <title>User Home</title>
</head>
<body>

<h2>Welcome, <!?php echo $_SESSION['FirstName']; ?>!</h2>
<p>You are logged in as a regular user.</p>
<a href="../auth/logout.php">Logout</a>
<a href="../submitTicket.php">Ticket</a>

</body>
</html>-->