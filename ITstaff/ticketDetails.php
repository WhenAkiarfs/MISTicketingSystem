<?php
// ticketDetails.php
session_start();
include '../Includes/config.php'; // Assumes $conn is a PDO instance

$ticketId = $_GET['id'] ?? null;

if ($ticketId) $ticketId = $_GET['id'] ?? null;

if ($ticketId) {
    $sql = "SELECT 
                t_tickets.TicketId, 
                t_tickets.TimeSubmitted, 
                t_tickets.Description,
                t_branch.BranchName, 
                t_tickets.TicketStatus, 
                CONCAT(staff.FirstName, ' ', staff.LastName) AS AssignedStaffName,
                CONCAT(emp.FirstName, ' ', emp.LastName) AS EmployeeName,
                t_asset.AssetName,
                t_asset.SerialNumber,
                t_asset.PropertyNumber,
                t_asset.Acquisition,
                t_issuedtype.IssueType, 
                t_issuedsubtype.SubTypeName
            FROM t_ticketissues
            INNER JOIN t_tickets ON t_ticketissues.TicketId = t_tickets.TicketId
            INNER JOIN t_branch ON t_tickets.BranchId = t_branch.BranchId
            INNER JOIN t_asset ON t_tickets.AssetId = t_asset.AssetId
            INNER JOIN t_issuedtype ON t_ticketissues.IssueId = t_issuedtype.IssueId
            LEFT JOIN t_issuedsubtype ON t_ticketissues.SubTypeId = t_issuedsubtype.SubTypeId
            LEFT JOIN t_users AS staff ON t_tickets.AssignedITstaffId = staff.UserId
            LEFT JOIN t_useremp ue ON t_tickets.EmployeeId = ue.EmployeeId
            LEFT JOIN t_users emp ON ue.UserId = emp.UserId
            WHERE t_tickets.TicketId = :ticketId;
            ";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute(['ticketId' => $ticketId]);
    $ticketDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Debugging info to check if logged in
//if (isset($_SESSION['UserId']) && isset($_SESSION['RoleId'])) {
    //echo "<p>Logged in as User ID: " . $_SESSION['UserId'] . " | Role ID: " . $_SESSION['RoleId'] . "</p>";
//} else {
  //  echo "<p>No active session. Please log in.</p>";
//}

if ($_SESSION['RoleId'] != 3) {
    header('Location: ../employee/home.php');
    exit();
}
$loggedInUserId = $_SESSION['UserId'];
$loggedInRoleId = $_SESSION['RoleId'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCPL STS - Ticket Details</title>
    <link rel="icon" type="image/x-icon" href="../asset/img/qcpl-sts-logo.png">

    <!-- External CSS -->
    <link rel="stylesheet" href="../asset/css/ticketDetails.css">'  

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="container mt-1">
    <div class="card shadow p-4">
        <div class="header mb-3 pb-2 border-bottom">
            <h2 class="mb-4">Ticket Information</h2>
        </div>

        <div class="card-body">
        <?php if (!empty($ticketDetails)): ?>
            <?php $first = $ticketDetails[0]; ?>
            
            <form action="updateTicketStatus.php" method="POST">
                <input type="hidden" name="assigned_it_staff_id" value="<?php echo htmlspecialchars($first['AssignedStaffName']); ?>">

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Ticket ID</label>
                        <input type="text" class="form-control rounded-pill" value="<?php echo htmlspecialchars($first['TicketId']); ?>" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Submitted At</label>
                        <input type="text" class="form-control rounded-pill" value="<?php echo htmlspecialchars($first['TimeSubmitted']); ?>" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Ticket Status</label>
                        <input type="text" class="form-control rounded-pill" value="<?php echo htmlspecialchars($first['TicketStatus']); ?>" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Branch</label>
                        <input type="text" class="form-control rounded-pill" value="<?php echo htmlspecialchars($first['BranchName']); ?>" readonly>
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label">Submitted By</label>
                        <input type="text" class="form-control rounded-pill" value="<?php echo htmlspecialchars($first['EmployeeName']); ?>" readonly>
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label">Assigned IT Staff</label>
                        <input type="text" class="form-control rounded-pill" value="<?php echo htmlspecialchars($first['AssignedStaffName']); ?>" readonly>
                    </div>
                </div>

                <hr class="my-3">
                <div class="row mb-3">
                    <h4 class="fw-bold" style="text-transform: uppercase; color: #ff0000; font-weight: 500; text-align: center;"><?php echo htmlspecialchars($first['AssetName']); ?></h4>
                    <div class="col-md-4">
                        <label class="form-label">Serial Number</label>
                        <input type="text" class="form-control rounded-pill" value="<?php echo htmlspecialchars($first['SerialNumber']); ?>" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Property Number</label>
                        <input type="text" class="form-control rounded-pill" value="<?php echo htmlspecialchars($first['PropertyNumber']); ?>" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Acquisition</label>
                        <input type="text" class="form-control rounded-pill" value="<?php echo htmlspecialchars($first['Acquisition']); ?>" readonly>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Reported Issue/s</label>
                    <div class="table-responsive mt-2">
                        <table class="table table-striped mb-0">
                            <thead class="table-light text-center">
                                <tr>
                                    <th scope="col">Issue</th>
                                    <th scope="col">Sub-Issue</th>
                                    <th scope="col">Description</th>
                                </tr>
                            </thead>
                            <tbody class="text-center align-middle">
                                <?php foreach ($ticketDetails as $row): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['IssueType']); ?></td>
                                        <td><?php echo !empty($row['SubTypeName']) ? htmlspecialchars($row['SubTypeName']) : '—'; ?></td>
                                        <td><?php echo !empty($row['Description']) ? htmlspecialchars($row['Description']) : '—'; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="mb-1">
                <?php if (strtolower($first['TicketStatus']) === 'pending'): ?>
                    <div class="d-flex gap-3 justify-content-center border-top pt-4">
                        <button type="submit" name="action" value="accept" class="btn btn-success rounded-pill">Accept</button>
                        <button type="submit" name="action" value="reject" class="btn btn-danger rounded-pill">Reject</button>
                    </div>
                </div>

                <div class="mb-1">
                <?php elseif (strtolower($first['TicketStatus']) === 'ongoing'): ?>
                    <div class="mb-2 d-flex justify-content-between align-items-center">
                        <label for="completion_message" class="form-label mb-0">Completion Message</label>

                        <!-- For Condemn Checkbox -->
                        <div class="form-check mb-0">
                            <input class="form-check-input" type="checkbox" name="is_condemned" id="is_condemned" value="1">
                            <label class="form-check-label" for="is_condemned">
                                For Condemn
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <textarea name="completion_message" id="completion_message" class="form-control rounded" rows="4" required
                            placeholder="Describe what was done to fix the issue..."></textarea>
                    </div>
                    <div class="d-flex justify-content-center border-top pt-4">
                        <button type="submit" name="action" value="complete" class="btn btn-primary rounded-pill">Complete</button>
                    </div>
                <?php endif; ?>
                </div>
            </form>

        <?php else: ?>
            <div class="alert alert-warning text-center">
                Ticket not found.
            </div>
        <?php endif; ?>
        </div>
        </div>
    </div>
</div>
</body>
</html>