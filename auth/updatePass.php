<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$updatePassSuccess = $_SESSION['updatePassSuccess'] ?? '';
$updatePassError = $_SESSION['updatePassError'] ?? '';
unset($_SESSION['updatePassSuccess'], $_SESSION['updatePassError']);
?>

<?php
include '../Includes/config.php';

// Handle POST submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_password'], $_POST['confirm_password'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (!isset($_SESSION['UserId'])) {
        $_SESSION['updatePassError'] = "User not logged in.";
    } elseif ($new_password !== $confirm_password) {
        $_SESSION['updatePassError'] = "Passwords do not match.";
    } else {
        try {
            $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
            $userId = $_SESSION['UserId'];

            $stmt = $conn->prepare("UPDATE t_users SET password = :password WHERE UserId = :id");
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':id', $userId);

            if ($stmt->execute()) {
                $_SESSION['updatePassSuccess'] = "Password updated successfully.";
            } else {
                $_SESSION['updatePassError'] = "Failed to update password. Try again.";
            }
        } catch (PDOException $e) {
            $_SESSION['updatePassError'] = "Database error: " . $e->getMessage();
        }
    }

    // Redirect back to referring page
    session_write_close();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
?>

<!-- External CSS Link -->
<link rel="stylesheet" href="../asset/css/modals.css">

<!-- Update Password Modal -->
<div class="modal fade" id="updatePassModal" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="../auth/updatePass.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="updatePassModalLabel">Password Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password:</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                        <small id="password-strength-text" class="form-text"></small>

                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password:</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        <small id="mismatch-error" class="form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Password Update Error Alert -->
<?php if (!empty($updatePassError)): ?>
    <div class="alert alert-danger position-fixed top-0 start-50 translate-middle-x mt-5 shadow-lg" id="pass-error" style="z-index: 1055;">
        <?= htmlspecialchars($updatePassError) ?>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const updatePassModal = document.getElementById('updatePassModal');
            if (updatePassModal) {
                const modal = new bootstrap.Modal(updatePassModal);
                modal.show();
            }

            setTimeout(() => {
                const alert = document.getElementById('pass-error');
                if (alert) alert.remove();
            }, 3000);
        });
    </script>
<?php endif; ?>

<!-- Password Update Success Alert -->
<?php if (!empty($updatePassSuccess)): ?>
    <div class="alert alert-success position-fixed top-0 start-50 translate-middle-x mt-5 shadow-lg" id="pass-success" style="z-index: 1055;">
    <?= htmlspecialchars($updatePassSuccess) ?>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modalEl = document.getElementById('updatePassModal');
            if (modalEl) {
                const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                modal.hide();
            }

            setTimeout(() => {
                const alert = document.getElementById('pass-success');
                if (alert) alert.remove();
            }, 3000);
        });
    </script>
<?php endif; ?>