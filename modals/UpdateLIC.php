<?php
include '../Includes/config.php'; // Ensure this is included at the top

if (isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success_message'] . "</div>";
    unset($_SESSION['success_message']); // Remove the message after displaying
}


//LIC table 
$sql = "SELECT * FROM t_users WHERE RoleId=2" ;
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

//LIC staff
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM t_users WHERE UserId = :id and RoleId=2";
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

    $sql = "UPDATE t_users SET FirstName = :firstName, LastName = :lastName, Email = :email, Contactno = :contactno WHERE UserId = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
        'contactno' => $contactno,
        'id' => $id
    ]);

    $_SESSION['success_message'] = "Successfully updated account!";
    header("Location: ../admin/adminBranchMgmt.php ");
    exit();
}
?>

<!-- Update LIC Modal -->
<div class="modal fade" id="updateLICModal" tabindex="-1" aria-labelledby="updateLICModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <form action="register.php" method="POST">
            <div class="modal-header">
            <h5 class="modal-title" id="updateLICModalLabel">Update LIC Information</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
            <form action="adminUpdateIT.php" method="POST">
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
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control rounded-pill" required>
                </div>
                </div>

                <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Contact No</label>
                    <input type="text" name="contactno" class="form-control rounded-pill" value="<?php echo $user['Contactno']; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="role" class="form-label">Role</label>
                    <select name="role_id" id="role" class="form-select rounded-pill" rows="3">
                        <option value="" default></option>
                        <!--?php 
                        $stmt = $conn->query("SELECT r.RoleName 
                                                    FROM t_roles 
                                                    WHERE RoleId == 2");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . $row['RoleId'] . '">' . $row['RoleName'] . '</option>';
                        }
                        ?>-->
                    </select>
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
        </div>
    </div>

        <!-- Update Confirmation Modal -->
        <div class="modal" id="updateConfirmationModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <i class="fa-solid fa-circle-question md-icon"></i>
                    <h1>Confirm Update</h1>
                    <h3>Are you sure you want to update the information?</h3>
                    <p class="p-warning mt-4">Once updated, the account information will be changed.</p>

                    <div class="modal-footer">
                    <div class="d-flex justify-content-around">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Confirm</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Successful Update Modal -->
    <div class="modal" id="successfulUpdateModal" tabindex="-1" aria-labelledby="successfulUpdateModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <i class="fa-regular fa-check-circle md-icon"></i>
                    <h1>Information Updated!</h1>
                    <p class="p-success mt-4">
                        See table for reflected changes.
                    </p>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary">Close</button>
                </div>
                </div>
            </div>
        </div>
    </div>