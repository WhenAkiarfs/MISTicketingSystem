<script>
    var pageTitle = "Dashboard";
</script>

<?php
include '../Includes/config.php';
include '../Includes/check_session.php';

$sql = "SELECT
            t_tickets.TicketId,
            MIN(t_tickets.TimeSubmitted) as TimeSubmitted,
            t_branch.BranchName,
            GROUP_CONCAT(t_issuedtype.IssueType SEPARATOR ', ') as Issues,
            t_tickets.AssignedITstaffId,
            t_tickets.TicketStatus
        FROM t_ticketissues
        JOIN t_tickets ON t_ticketissues.TicketId = t_tickets.TicketId
        JOIN t_branch ON t_tickets.BranchId = t_branch.BranchId
        JOIN t_issuedtype ON t_ticketissues.IssueId = t_issuedtype.IssueId
        GROUP BY t_tickets.TicketId, t_branch.BranchName, t_tickets.AssignedITstaffId, t_tickets.TicketStatus
        ORDER BY TimeSubmitted ASC";

$stmt = $conn->prepare($sql);
$stmt->execute();
$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pendingCount = 0;
$ongoingCount = 0;
$completedCount = 0;

foreach ($tickets as $ticket) {
    switch (strtolower($ticket['TicketStatus'])) {
        case 'pending':
            $pendingCount++;
            break;
        case 'ongoing':
            $ongoingCount++;
            break;
        case 'completed':
            $completedCount++;
            break;
    }
}

$totalCount = count($tickets);

if ($_SESSION['RoleId'] != 4) {
    header('Location: ..auth/login_error.php');
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
    <link rel="stylesheet" href="../asset/css/notif.css">
    <link rel="stylesheet" href="../asset/css/greeting.css">
    <link rel="stylesheet" href="../asset/css/ticket-cards.css">
    <link rel="stylesheet" href="../asset/css/navtabs.css">
    <link rel="stylesheet" href="../asset/css/tbl_charts.css">
    <link rel="stylesheet" href="../asset/css/tbl-controls.css">
    
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
    <script src="../asset/js/notif.js"></script>
    <script src="../asset/js/greetingCard.js"></script>
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
                                <div class="location-tag-client">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span id="location">Quezon City, Philippines</span>
                                </div>
                                <div class="submit-ticket-wrapper d-flex justify-content-start align-items-end" style="height: 50%;">
                                    <button type="button" class="btn btn-dashboard" data-bs-toggle="modal" data-bs-target="#submitTicketModal">
                                        Submit a Ticket
                                    </button>
                                </div>
                            </div>
                            <img src="../asset/img/LIC-emp_dashboard.png" alt="QCPL STS Welcome Card" class="card-image">
                        </div>
                    </div>

                    <?php

try {
    $recentQuery = "
        SELECT
            t_tickets.TicketId,
            t_tickets.TimeSubmitted,
            t_branch.BranchName,
            GROUP_CONCAT(t_issuedtype.IssueType SEPARATOR ', ') AS Issues,
            t_tickets.TicketStatus
        FROM t_ticketissues
        JOIN t_tickets ON t_ticketissues.TicketId = t_tickets.TicketId
        JOIN t_branch ON t_tickets.BranchId = t_branch.BranchId
        JOIN t_issuedtype ON t_ticketissues.IssueId = t_issuedtype.IssueId
        GROUP BY t_tickets.TicketId, t_tickets.TimeSubmitted, t_branch.BranchName, t_tickets.TicketStatus
        ORDER BY t_tickets.TimeSubmitted DESC
        LIMIT 1
    ";

    $stmt = $conn->prepare($recentQuery);
    $stmt->execute();
    $recentTicket = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$displayTicketId = substr($recentTicket['TicketId'], -6);

function abbreviateBranch($branchName) {
    $words = explode(' ', $branchName);
    $abbreviation = '';
    foreach ($words as $word) {
        $abbreviation .= strtoupper($word[0]);
    }
    return $abbreviation;
}

$abbreviatedBranch = abbreviateBranch($recentTicket['BranchName']);
?>
                    <!-- Recent Ticket Card -->
                    <div class="col-md-4 mb-3">
                        <div class="ticket-container">
                            <div class="ticket-header">
                                <h5 class="fw-bold text-center" id="ticket-title">RECENT TICKET</h5>
                            </div>
                            
                            <div class="ticket-body">
                                <div class="ticket-grid">
                                    <div>Ticket ID<br><span id="ticket-id"><?= htmlspecialchars($displayTicketId) ?></span></div>
                                    <div>Status<br><span id="ticket-status"><?= htmlspecialchars($recentTicket['TicketStatus']) ?></span></div>
                                </div>
                                <div class="ticket-grid">
                                    <div>Branch<br><span id="ticket-branch"><?= htmlspecialchars($abbreviatedBranch) ?></span></div>

                                    <div>Issue<br><span id="ticket-issue"><?= htmlspecialchars($recentTicket['Issues']) ?></span></div>
                                </div>

                                <?php
                                    $dateTime = new DateTime($recentTicket['TimeSubmitted']);
                                    $formattedDate = $dateTime->format('F d, Y');
                                    $formattedTime = $dateTime->format('H:i:s');
                                ?>
                                <div class="ticket-grid">
                                    <div>Date<br><span id="ticket-date"><?= $formattedDate ?></span></div>
                                    <div>Time<br><span id="ticket-time"><?= $formattedTime ?></span></div>
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
                <div class="container-fluid mt-4">
                    <h3 class="fw-bold mb-3" id="ticket-summary-title">Ticket Summary</h3>
                    <div class="row" style="height: 395px;">
                    <!-- Left: Summary Cards -->
                    <div class="col-lg-4 d-flex flex-column justify-content-between h-100">
                        <div class="row g-3 h-100">
                        <!-- Cards Row 1 -->
                        <div class="col-6 d-flex">
                            <div class="ticket-card pending w-100 h-100 text-center p-3">
                            <i class="fa-solid fa-triangle-exclamation fa-2x mb-2"></i>
                            <h5>Pending</h5>
                            <p class="ticket-count fs-4"><?= $pendingCount ?></p>
                            </div>
                        </div>
                        <div class="col-6 d-flex">
                            <div class="ticket-card ongoing w-100 h-100 text-center p-3">
                            <i class="fa-solid fa-sync-alt fa-spin fa-2x mb-2"></i>
                            <h5>On Going</h5>
                            <p class="ticket-count fs-4"><?= $ongoingCount ?></p>
                            </div>
                        </div>
                        <!-- Cards Row 2 -->
                        <div class="col-6 d-flex mt-4">
                            <div class="ticket-card completed w-100 h-100 text-center p-3">
                            <i class="fa-solid fa-circle-check fa-2x mb-2"></i>
                            <h5>Completed</h5>
                            <p class="ticket-count fs-4"><?= $completedCount ?></p>
                            </div>
                        </div>
                        <div class="col-6 d-flex mt-4">
                            <div class="ticket-card total w-100 h-100 text-center p-3">
                            <i class="fa-solid fa-clipboard fa-2x mb-2"></i>
                            <h5>Total</h5>
                            <p class="ticket-count fs-4"><?= $totalCount ?></p>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- Right: Charts -->
                    <div class="col-lg-8">
                        <div class="row h-100">
                        <!-- Column 1: Donut Chart Spanning Two Rows -->
                        <div class="col-md-6 d-flex flex-column">
                            <div class="chart-card flex-fill p-3 mb-3">
                            <canvas id="branchMostTicketChart"></canvas>
                            </div>
                        </div>

                        <!-- Column 2: Stacked Bar Charts -->
                        <div class="col-md-6">
                            <!-- Row 1: Main Branch Top Issues -->
                            <div class="chart-card p-3 mb-3">
                            <canvas id="mainBranchIssueChart"></canvas>
                            </div>
                            <!-- Row 2: Other Branches Top Issues -->
                            <div class="chart-card p-3 mb-3">
                            <canvas id="otherBranchIssueChart"></canvas>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    </div>

                    <!-- Tabs for Ticket Summary -->
                    <div class="d-flex justify-content-between align-items-center mb-1 mt-4 flex-wrap">
                    <!-- Ticket Status Tabs -->
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

                    <!-- Filter and View Link Container -->
                    <div class="d-flex align-items-center gap-3 ms-auto mt-2 mt-md-0">
                        <!-- Branch Filter Dropdown -->
                        <div class="dropdown branch-filter me-2">
                        <button class="btn btn-outline-primary dropdown-toggle rounded-pill filter-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-filter"></i>
                            <span>Filter by Branch</span>
                        </button>
                        <ul class="dropdown-menu px-2" id="branchDropdown">
                            <!-- Search input inside dropdown -->
                            <li class="mb-2">
                            <input type="text" class="form-control" id="branchSearchInput" placeholder="Search Branch...">
                            </li>

                            <!-- Generated branch list -->
                            <?php
                                include '../Includes/config.php';
                                $stmt = $conn->query("SELECT BranchId, BranchName FROM t_branch");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<li><a class="dropdown-item" href="?branch=' . $row['BranchId'] . '">' . htmlspecialchars($row['BranchName']) . '</a></li>';
                                }
                            ?>
                        </ul>
                        </div>

                        <!-- View All Tickets Link -->
                        <button class="btn btn-outline-primary rounded-pill view-tix-btn" onclick="location.href='adminTicketMgmt.php'">
                            <span>View All Tickets</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                    </div>

                    <!-- Tab Content Container -->
                    <div class="tab-content" id="nav-tix-content">
                    <!-- Pending Tab -->
                    <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                        <div class="table-responsive mt-0">
                            <table id="TicketTablePending" class="table table-striped table-bordered table-hover mb-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Ticket ID</th>
                                        <th>Submitted At</th>
                                        <th>Branch</th>
                                        <th>Issue</th>
                                        <th>Assigned IT</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tickets as $ticket) : ?>
                                        <?php if ($ticket['TicketStatus'] == 'Pending') : ?>
                                            <tr>
                                                <td><?= htmlspecialchars($ticket['TicketId']) ?></td>
                                                <td><?= htmlspecialchars($ticket['TimeSubmitted']) ?></td>
                                                <td><?= htmlspecialchars($ticket['BranchName']) ?></td>
                                                <td><?= htmlspecialchars($ticket['Issues']) ?></td>
                                                <td><?= htmlspecialchars($ticket['AssignedITstaffId']) ?></td>
                                                <td><?= htmlspecialchars($ticket['TicketStatus']) ?></td>
                                                <td>
                                                    <a href="ticketDetails.php?id=<?= urlencode($ticket['TicketId']) ?>" class="btn btn-sm btn-primary">View</a>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Ongoing Tab -->
                    <div class="tab-pane fade" id="ongoing" role="tabpanel" aria-labelledby="ongoing-tab">
                        <div class="table-responsive mt-0">
                            <table id="TicketTableOngoing" class="table table-striped table-bordered table-hover mb-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Ticket ID</th>
                                        <th>Submitted At</th>
                                        <th>Branch</th>
                                        <th>Issue</th>
                                        <th>Assigned IT</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tickets as $ticket) : ?>
                                        <?php if ($ticket['TicketStatus'] == 'Ongoing') : ?>
                                            <tr>
                                                <td><?= htmlspecialchars($ticket['TicketId']) ?></td>
                                                <td><?= htmlspecialchars($ticket['TimeSubmitted']) ?></td>
                                                <td><?= htmlspecialchars($ticket['BranchName']) ?></td>
                                                <td><?= htmlspecialchars($ticket['Issues']) ?></td>
                                                <td><?= htmlspecialchars($ticket['AssignedITstaffId']) ?></td>
                                                <td><?= htmlspecialchars($ticket['TicketStatus']) ?></td>
                                                <td>
                                                    <a href="ticketDetails.php?id=<?= urlencode($ticket['TicketId']) ?>" class="btn btn-sm btn-primary">View</a>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Completed Tab -->
                    <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                        <div class="table-responsive mt-0">
                            <table id="TicketTableCompleted" class="table table-striped table-bordered table-hover mb-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Ticket ID</th>
                                        <th>Submitted At</th>
                                        <th>Branch</th>
                                        <th>Issue</th>
                                        <th>Assigned IT</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tickets as $ticket) : ?>
                                        <?php if ($ticket['TicketStatus'] == 'Completed') : ?>
                                            <tr>
                                                <td><?= htmlspecialchars($ticket['TicketId']) ?></td>
                                                <td><?= htmlspecialchars($ticket['TimeSubmitted']) ?></td>
                                                <td><?= htmlspecialchars($ticket['BranchName']) ?></td>
                                                <td><?= htmlspecialchars($ticket['Issues']) ?></td>
                                                <td><?= htmlspecialchars($ticket['AssignedITstaffId']) ?></td>
                                                <td><?= htmlspecialchars($ticket['TicketStatus']) ?></td>
                                                <td>
                                                    <a href="ticketDetails.php?id=<?= urlencode($ticket['TicketId']) ?>" class="btn btn-sm btn-primary">View</a>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Ticket Modal -->
    <?php include '../modals/submitTicket.php'; ?>

    <!-- View Ticket Info Modal -->
    <?php include '../modals/viewTicketInfo.php'; ?>

    <!-- External JS Link/s -->
    <script src="../asset/js/sidebar.js"></script>
    <script src="../asset/js/notif.js"></script>
    <script src="../asset/js/adminCharts.js"></script>
    <script src="../asset/js/greetingCard.js"></script>
    <script src="../asset/js/recentTicket.js"></script>
    <script src="../asset/js/ticketSummary.js"></script>
    <script src="../asset/js/adminNavTables.js"></script>

    <!-- Filter by Branch Live Search -->
    <script>
    document.getElementById('branchSearchInput').addEventListener('keyup', function () {
        const filter = this.value.toLowerCase();
        const items = document.querySelectorAll('#branchDropdown li a.dropdown-item');

        items.forEach(item => {
        const text = item.textContent.toLowerCase();
        const li = item.closest('li');
        li.style.display = text.includes(filter) ? '' : 'none';
        });
    });
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
    const donutCtx = document.getElementById('branchMostTicketChart').getContext('2d');

    fetch('../admin/getBranchTicketData.php')
        .then(response => response.json())
        .then(chartData => {
        new Chart(donutCtx, {
            type: 'doughnut',
            data: {
            labels: chartData.labels,
            datasets: [{
                data: chartData.data,
                backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1', '#17a2b8'], // Add more if needed
                borderRadius: 5,
                hoverOffset: 8
            }]
            },
            options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                position: 'bottom',
                labels: {
                    font: {
                    size: 12,
                    family: "Inter"
                }
                }
                },
                title: {
                display: true,
                text: "Branches with Most Tickets",
                font: {
                    size: 20,
                    family: 'Inter',
                    weight: 'bold'
                },
                padding: {
                    top: 5,
                    bottom: 12
                }
                }
            }
            }
        });
        })
        .catch(error => {
        console.error('Error loading donut chart data:', error);
        });
    });
    </script>
</body>
</html>