<?php
session_start();
require_once '../Includes/config.php';

// Get POST data safely
$employeeId = $_POST['EmployeeId'] ?? null;
$branchId = $_POST['BranchId'] ?? null;
$districtId = $_POST['DistrictId'] ?? null;
$assetId = $_POST['AssetId'] ?? null;

// Now assume IssueId and SubtypeId are arrays from the form (multiple selections)
$issueIds = $_POST['IssueId'] ?? [];
$subtypeIds = $_POST['SubtypeId'] ?? [];

$description = $_POST['Description'] ?? null;
if (is_array($description)) {
    $description = implode("\n", $description); // Join multiple descriptions if given
}

// Basic validation
if (!$employeeId || !$branchId || !$districtId || !$assetId || empty($issueIds) || empty($subtypeIds) || !$description) {
    die('Please fill in all required fields.');
}

if (count($issueIds) !== count($subtypeIds)) {
    die('Issue and Subtype count mismatch.');
}

try {
    // Fetch BranchName for TicketId generation
    $stmt = $conn->prepare("SELECT BranchName FROM t_branch WHERE BranchId = ?");
    $stmt->execute([$branchId]);
    $branchName = $stmt->fetchColumn();

    if (!$branchName) {
        throw new Exception("Invalid Branch ID.");
    }

    // Generate custom TicketId
    $datePart = date('ymd'); // yymmdd
    $timePart = date('His'); // HHMMSS
    $branchCode = strtoupper(substr($branchName, 0, 3) . substr($branchName, -1)); // First 3 + last letter
    $empPadded = str_pad($employeeId, 4, '0', STR_PAD_LEFT); // Pad to 4 digits
    $ticketId = "{$branchId}-{$branchCode}-{$datePart}-{$empPadded}-{$timePart}";

     // Insert ticket
    $stmt = $conn->prepare("
        INSERT INTO t_tickets
        (TicketId, EmployeeId, BranchId, DistrictId, AssetId, Description, TimeSubmitted)
        VALUES (?, ?, ?, ?, ?, ?, NOW())
    ");

    $stmt->execute([
        $ticketId,
        $employeeId,
        $branchId,
        $districtId,
        $assetId,
    
        $description,
    
    ]);

    // Insert each IssueId and SubtypeId pair into t_ticketissues
    $stmt = $conn->prepare("
        INSERT INTO t_ticketissues (TicketId, IssueId, SubtypeId) VALUES (?, ?, ?)
    ");
    for ($i = 0; $i < count($issueIds); $i++) {
        $stmt->execute([$ticketId, $issueIds[$i], $subtypeIds[$i]]);
    }

    echo "Ticket submitted successfully with ID: $ticketId";

} catch (Exception $e) {
    echo "Error submitting ticket: " . $e->getMessage();
}

?>