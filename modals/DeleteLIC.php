<?php
include '../Includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteUserId'])) {
    $id = $_POST['deleteUserId'];

    // Delete from role-specific tables
    $roleTables = ['t_admin', 't_branchadmin', 't_itstaff', 't_useremp'];
    foreach ($roleTables as $table) {
        $sql = "DELETE FROM $table WHERE UserId = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    // Delete from t_users
    $sql = "DELETE FROM t_users WHERE UserId = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);

    $_SESSION['deletion_success'] = true;
    header("Location: adminBranchMgmt.php"); // not ../admin/ if already in /admin
    exit();
}
?>

<!--?php
include '../Includes/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete from role-specific tables first
    $roleTables = ['t_admin', 't_branchadmin', 't_itstaff', 't_useremp'];
    foreach ($roleTables as $table) {
        $sql = "DELETE FROM $table WHERE UserId = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    // Delete from t_users
    $sql = "DELETE FROM t_users WHERE UserId = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);

    $_SESSION['success_message'] = "Successfully deleted account!";
    header("Location: ../admin/ManageBranch.php");
    exit();
}
?>-->

<!-- External CSS Link -->
<link rel="stylesheet" href="../asset/css/modals.css">

<!-- Font Awesome CDN Link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- Confirm Delete Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form action="adminDeleteIT.php" method="POST" class="modal-content md-cont p-3">
      <div class="modal-body text-center">
        <i class="fa-solid fa-trash md-icon"></i>
        <h2 class="modal-title">Confirm Deletion</h2>
        <p>Are you sure you want to delete this account?</p>
        <input type="hidden" name="deleteUserId" id="deleteUserId">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Confirm</button>
      </div>
    </form>
  </div>
</div>

<!-- Deletion Success Modal -->
<div class="modal fade" id="deletionSuccessModal" tabindex="-1" aria-labelledby="deletionSuccessModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content md-cont p-3">
      <div class="modal-body text-center">
        <i class="fa-regular fa-circle-check md-icon"></i>
        <h2 class="modal-title">Successfully Deleted</h2>
        <p>You have successfully deleted an LIC Account.</p>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>