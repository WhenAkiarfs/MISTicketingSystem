<?php
include '../Includes/config.php'; // Ensure this is included at the top

if (isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success_message'] . "</div>";
    unset($_SESSION['success_message']); // Remove the message after displaying
}

//IT staff table 
$sql = "SELECT * FROM t_users WHERE RoleId=3 " ;
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

//update IT staff
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateUserId'])) {
        $id = $_POST['updateUserId'];

    $sql = "SELECT * FROM t_users WHERE UserId = :id and RoleId=3";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];

    $sql = "UPDATE t_users SET 
            FirstName = :firstName, 
            LastName = :lastName, 
            Email = :email, 
            Contactno = :contactno 
            WHERE UserId = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
        'contactno' => $contactno,
        'id' => $id
]);

    $_SESSION['update_success'] = true;
    header("Location: ../admin/adminStaffMgmt.php ");
    exit();
}
?>

<!-- External CSS Link -->
<link rel="stylesheet" href="../asset/css/modals.css">

<!-- Font Awesome CDN Link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- Update IT Modal -->
    <div class="modal fade" id="updateITModal" tabindex="-1" aria-labelledby="updateITModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <form method="POST">
            <div class="modal-header">
            <h5 class="modal-title" id="updateITModalLabel">Update IT Information</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
            
                <input type="hidden" name="id" value="<?php echo $user['UserId']; ?>">

                <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control rounded-pill" value="<?php echo $user['FirstName']; ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control rounded-pill" value="<?php echo $user['LastName']; ?>" required>
                </div>
                </div>

                <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control rounded-pill" value="<?php echo $user['Email']; ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Contact No</label>
                    <input type="text" name="contactno" class="form-control rounded-pill" value="<?php echo $user['Contactno']; ?>" required>
                </div>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        </div>
    </div>