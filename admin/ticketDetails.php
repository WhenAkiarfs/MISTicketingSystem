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
                t_tickets.AssignedITstaffId,
                t_issuedtype.IssueType, 
                t_issuedsubtype.SubTypeName
            FROM t_ticketissues
            INNER JOIN t_tickets ON t_ticketissues.TicketId = t_tickets.TicketId
            INNER JOIN t_branch ON t_tickets.BranchId = t_branch.BranchId
            INNER JOIN t_issuedtype ON t_ticketissues.IssueId = t_issuedtype.IssueId
            LEFT JOIN t_issuedsubtype ON t_ticketissues.SubTypeId = t_issuedsubtype.SubTypeId
            WHERE t_tickets.TicketId = :ticketId";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute(['ticketId' => $ticketId]);
    $ticketDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Debugging info to check if logged in
if (isset($_SESSION['UserId']) && isset($_SESSION['RoleId'])) {
    echo "<p>Logged in as User ID: " . $_SESSION['UserId'] . " | Role ID: " . $_SESSION['RoleId'] . "</p>";
} else {
    echo "<p>No active session. Please log in.</p>";
}

if ($_SESSION['RoleId'] != 1) {
    header('Location: ../employee/home.php');
    exit();
}
$loggedInUserId = $_SESSION['UserId'];
$loggedInRoleId = $_SESSION['RoleId'];

?>


<?php if (!empty($ticketDetails)): ?>
    <?php $first = $ticketDetails[0]; ?>
    <h2>Ticket Details - #<?php echo htmlspecialchars($first['TicketId']); ?></h2>
    <p><strong>Submitted At:</strong> <?php echo htmlspecialchars($first['TimeSubmitted']); ?></p>
    <p><strong>Branch:</strong> <?php echo htmlspecialchars($first['BranchName']); ?></p>
    <p><strong>Status:</strong> <?php echo htmlspecialchars($first['TicketStatus']); ?></p>
    <p><strong>Description:</strong> <?php echo htmlspecialchars($first['Description']); ?></p>

    <h4>Reported Issues:</h4>
    <ul>
        <?php foreach ($ticketDetails as $row): ?>
            <li>
                <strong>Issue:</strong> <?php echo htmlspecialchars($row['IssueType']); ?>
                <?php if (!empty($row['SubTypeName'])): ?>
                    - <strong>Subtype:</strong> <?php echo htmlspecialchars($row['SubTypeName']); ?>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <form action="updateTicketStatus.php" method="POST">
        <input type="hidden" name="ticket_id" value="<?php echo htmlspecialchars($first['TicketId']); ?>">
        <input type="hidden" name="assigned_it_staff_id" value="<?php echo htmlspecialchars($first['AssignedITstaffId']); ?>">
        
        <?php if (strtolower($first['TicketStatus']) === 'pending'): ?>
            <button type="submit" name="action" value="accept" class="btn btn-success">Accept</button>
            <button type="submit" name="action" value="reject" class="btn btn-danger">Reject</button>
        <?php elseif (strtolower($first['TicketStatus']) === 'ongoing'): ?>
            <label for="completion_message"><strong>Completion Message:</strong></label><br>
            <textarea name="completion_message" id="completion_message" rows="4" cols="50" required placeholder="Describe what was done to fix the issue..."></textarea><br><br>
            <button type="submit" name="action" value="complete" class="btn btn-primary">Complete</button>
        <?php endif; ?>


    </form>

<?php else: ?>
    <p>Ticket not found.</p>
<?php endif; ?>