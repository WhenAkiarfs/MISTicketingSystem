<?php
include '../Includes/config.php'; // PDO $conn
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ticketId = $_POST['ticket_id'] ?? null;
    $action = $_POST['action'] ?? null;
    $userId = $_SESSION['UserId'] ?? null; // Assuming user ID is stored in session

    if (!$ticketId || !$action || !$userId) {
        echo "Invalid request.";
        exit;
    }

    if ($action === 'accept' || $action === 'reject') {
        // Accept or reject: update status and assign IT staff
        $newStatus = ($action === 'accept') ? 'Ongoing' : 'Cancelled';

        $sql = "UPDATE t_tickets 
                SET TicketStatus = :status, AssignedITstaffId = :userId
                WHERE TicketId = :ticketId";
        $stmt = $conn->prepare($sql);
        $success = $stmt->execute([
            'status' => $newStatus,
            'userId' => $userId,
            'ticketId' => $ticketId
        ]);

        if ($success) {
            $message = ($action === 'accept') 
                ? "Ticket successfully accepted and assigned for fixing." 
                : "Ticket has been rejected/cancelled.";
            header("Location: admindashboard.php?msg=" . urlencode($message));
            exit;
        }

    } elseif ($action === 'complete') {
        // Complete: update status, resolution, and time resolved
        $completionMessage = $_POST['completion_message'] ?? '';

        if (trim($completionMessage) === '') {
            echo "Completion message is required.";
            exit;
        }

        $sql = "UPDATE t_tickets 
                SET TicketStatus = 'Completed', 
                    Resolution = :resolution, 
                    TimeResolved = NOW()
                WHERE TicketId = :ticketId AND AssignedITstaffId = :userId";
        $stmt = $conn->prepare($sql);
        $success = $stmt->execute([
            'resolution' => $completionMessage,
            'ticketId' => $ticketId,
            'userId' => $userId
        ]);

        if ($success) {
            $message = "Ticket is completed and marked as fixed.";
            header("Location: ITdashboard.php?msg=" . urlencode($message));
            exit;
        }
    } else {
        echo "Unknown action.";
        exit;
    }

    echo "Failed to update ticket.";
} else {
    echo "Access denied.";
}
?>