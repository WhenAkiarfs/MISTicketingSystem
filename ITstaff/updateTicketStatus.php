<?php
include '../Includes/config.php'; // PDO $conn
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ticketId = $_POST['ticket_id'] ?? null;
    $action = $_POST['action'] ?? null;
    $userId = $_SESSION['UserId'] ?? null; // Assuming user ID is stored in session

    if ($ticketId && in_array($action, ['accept', 'reject']) && $userId ) {
        // Use only allowed ENUM values
        $newStatus = ($action === 'accept') ? 'Ongoing' : 'Cancelled';

        $sql = "UPDATE t_tickets 
                SET TicketStatus = :status , AssignedITstaffId = :userId
                WHERE TicketId = :ticketId";
        $stmt = $conn->prepare($sql);
        $success = $stmt->execute([
            'status' => $newStatus,
            'userId' => $userId, // Assuming IT staff ID is stored in session
            'ticketId' => $ticketId
        ]);

        if ($success) {
            header("Location: ITdashboard.php?id=" . urlencode($ticketId) . "&updated=1");
            exit;
        } else {
            echo "Failed to update ticket status.";
        }
    } else {
        echo "Invalid request.";
    }
} else {
    echo "Access denied.";
}
?>