<?php
require '../Includes/config.php'; // Adjust path if needed

$sql = "SELECT b.BranchName, COUNT(t.TicketId) AS TicketCount
        FROM t_tickets t
        JOIN t_branch b ON t.BranchId = b.BranchId
        GROUP BY t.BranchId
        ORDER BY TicketCount DESC";

$stmt = $conn->prepare($sql);
$stmt->execute();

$labels = [];
$data = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $labels[] = $row['BranchName'];
    $data[] = (int)$row['TicketCount'];
}

echo json_encode([
    'labels' => $labels,
    'data' => $data
]);
?>