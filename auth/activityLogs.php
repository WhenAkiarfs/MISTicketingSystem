<script>
  var pageTitle = "Activity Logs";
</script>

<?php
session_start();
include '../Includes/config.php';

if (!isset($_SESSION['UserId']) || !isset($_SESSION['RoleId'])) {
    header('Location: ../login.php');
    exit();
}

$userId = $_SESSION['UserId'];
$roleId = $_SESSION['RoleId'];
$firstName = $_SESSION['FirstName'];

if ($isAdmin = $roleId == 1) {
    // Admin sees all logs
    $sql = "SELECT al.id, u.FirstName, r.RoleName, b.BranchName, al.activity_type, al.activity_time 
            FROM t_activitylogs al
            JOIN t_users u ON al.UserId = u.UserId
            JOIN t_roles r ON u.RoleId = r.RoleId
            JOIN t_branch b ON u.BranchId = b.BranchId
            ORDER BY al.activity_time DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
} else {
    // Other users (IT Staff, LIC, and Employee) see their own logs
    $sql = "SELECT al.id, al.activity_type, al.activity_time 
            FROM t_activitylogs al
            WHERE al.UserId = :UserId
            ORDER BY al.activity_time DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['UserId' => $userId]);
}

$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Redirect link based on role
$redirectLink = match ($roleId) {
    1 => '../admin/admindashboard.php',
    2 => '../branchadmin/licDashboard.php',
    3 => '../ITstaff/ITdashboard.php',
    default => '../employee/home.php',
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCPL STS - Activity Logs</title>
    <link rel="icon" type="image/x-icon" href="../asset/img/qcpl-sts-logo.png">

    <!-- External CSS Link/s -->
    <link rel ="stylesheet" href="../asset/css/sidebar.css">
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

    <!-- External JS Link/s -->
    <script src="../asset/js/sidebar.js"></script>
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
                        <button class="btn btn-back" onclick="window.location.href = '<?php echo $redirectLink; ?>'">
                        <i class="fa-solid fa-arrow-left me-1"></i>Back</button>
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
                    
                    <!-- Date Button -->
                    <button class="btn btn-outline-secondary control-btn" type="button">
                        <i class="fa fa-calendar me-1"></i> Select Date
                    </button>

                    <?php if ($roleId == 1 || $roleId == 3) { ?>
                    <!-- Filter Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle control-btn" type="button" data-bs-toggle="dropdown">
                            <i class="fa fa-filter me-1"></i>
                        </button>
                        <ul class="dropdown-menu shadow-sm p-2 rounded-3 border-0">
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-user-circle me-2"></i>Role</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-location-dot me-2"></i>Branch</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-chart-simple me-2"></i>Activity</a></li>
                        </ul>
                    </div>
                    <?php } ?>

                    <!-- Sort Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle control-btn" type="button" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-sort"></i>
                        </button>
                        <ul class="dropdown-menu shadow-sm p-2 rounded-3 border-0">
                            <li><a class="dropdown-item py-2 px-3" href="#"><i class="fa-solid fa-sort-alpha-up me-2"></i>Ascending</a></li>
                            <li><a class="dropdown-item py-2 px-3" href="#"><i class="fa-solid fa-sort-alpha-down me-2"></i>Descending</a></li>
                        </ul>
                    </div>
                </div>
                </div>

        <!-- Table for displaying activity logs -->
        <div class="row no-gutters mt-4">
                <div class="col-12">
                    <div class="row no-gutters">
                        <div class="col-6">
                            <h2 class="mb-4"><?= $roleId == 1 ? "All User Activity" : "$firstName's Activity Logs" ?></h2>
                        </div>
                        <div class="col-6">
                            <div class="d-flex flex-wrap align-items-center justify-content-end">
                                <?php if ($roleId == 1 && $roleId == 3): ?>
                                    <button class="btn btn-download" type="button" data-bs-toggle="modal" data-bs-target="#downloadReportModal">
                                        <i class="fa-solid fa-download me-1"></i> Download Report
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                        <table id="logsTable" class="table table-striped table-hover">
                            <thead class="table-dark">
                            <tr>
                                <?php if ($roleId == 1): ?>
                                    <th style="width: 3%">User</th>
                                    <th style="width: 3%">Role</th>
                                    <th style="width: 3%">Branch</th>
                                <?php endif; ?>
                                <th style="width: 3%">Activity</th>
                                <th style="width: 3%">Timestamp</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php if (count($logs) > 0): ?>
                                    <?php foreach ($logs as $log): ?>
                                        <tr>
                                            <?php if ($roleId == 1): ?>
                                                <td><?= htmlspecialchars($log['FirstName']) ?></td>
                                                <td><?= htmlspecialchars($log['RoleName']) ?></td>
                                                <td><?= htmlspecialchars($log['BranchName']) ?></td>
                                            <?php endif; ?>
                                            <td><?= htmlspecialchars($log['activity_type']) ?></td>
                                            <td><?= htmlspecialchars($log['activity_time']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="<?= $roleId == 1 ? 5 : 2 ?>" class="text-center">No activity logs found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </div>
    </div>

    <!-- Download Report Modal -->
    <!?php include '../admin/modals/adminDownloadReport.php'; ?>

    <script>
  document.getElementById('searchInput').addEventListener('keyup', function () {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#logsTable tbody tr');

    rows.forEach(row => {
      const cells = Array.from(row.getElementsByTagName('td'));
      const match = cells.some(cell => cell.textContent.toLowerCase().includes(filter));
      row.style.display = match ? '' : 'none';
    });
  });
</script>
</body>
</html>