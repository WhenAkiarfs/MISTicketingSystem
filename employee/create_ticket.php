<?php
include '../Includes/config.php';
include '../Includes/check_session.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get POST data
    $employeeId = $_POST['EmployeeId'] ?? null;
    $branchId = $_POST['BranchId'] ?? null;
    $districtId = $_POST['DistrictId'] ?? null;
    $assetId = $_POST['AssetId'] ?? null;
    $issueId = $_POST['IssueId'] ?? null;
    $subtypeId = $_POST['SubtypeId'] ?? null;
    $description = $_POST['Description'] ?? '';
    $priority = $_POST['Priority'] ?? 'Low';

    // Basic validation
    if ($employeeId && $assetId && $issueId && $subtypeId) {
        try {
            $stmt = $conn->prepare("INSERT INTO t_tickets (EmployeeId, BranchId, DistrictId, AssetId, IssueId, SubtypeId, Description, Priority, TimeSubmitted) 
            VALUES (:employeeId, :branchId, :districtId, :assetId, :issueId, :subtypeId, :description, :priority, NOW())");

///////////
$stmt->execute([
    ':employeeId' => $employeeId,
    ':branchId' => $branchId, // now binding the correct parameter for branch
    ':districtId' => $districtId,
    ':assetId' => $assetId,
    ':issueId' => $issueId,
    ':subtypeId' => $subtypeId,
    ':description' => $description,
    ':priority' => $priority
]);

            echo "Ticket submitted successfully.";
        } catch (PDOException $e) {
            echo "Error inserting ticket: " . $e->getMessage();
        }
    } else {
        echo "All required fields must be filled.";
    }
} else {
    echo "Invalid request method.";
}
?>
