<?php
include '../Includes/config.php'; // Ensure this is included at the top

//if (isset($_SESSION['success_message'])) {
    //echo "<div class='alert alert-success'>" . $_SESSION['success_message'] . "</div>";
    //unset($_SESSION['success_message']); // Remove the message after displaying
//}

if (isset($_SESSION['success_message'])): ?>
    <div id="successModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <p><?php echo $_SESSION['success_message']; ?></p>
      </div>
    </div>
    <?php unset($_SESSION['success_message']); ?>
    <?php endif; 

?>

<!-- External CSS Link -->
<link rel="stylesheet" href="../asset/css/modals.css">

<!-- Register LIC Modal -->
    <div class="modal fade" id="registerEmpModal" tabindex="-1" aria-labelledby="registerEmpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
        <form action="../admin/register.php" method="POST">
            <div class="modal-header">
            <h5 class="modal-title" id="registerEmpModalLabel">Register an Employee</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row mb-3">
                <div class="col-md-6">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" name="first_name" id="Firstname" class="form-control rounded-pill" required>
                </div>
                <div class="col-md-6">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" name="last_name" id="Lastname" class="form-control rounded-pill" required>
                </div>
                </div>

                <div class="row mb-3">
                <div class="col-md-6">
                    <label for="emailAddress" class="form-label">Email</label>
                    <input type="text" name="email" id="Emailaddress" class="form-control rounded-pill" required>
                </div>
                <div class="col-md-6">
                    <label for="contactNumber" class="form-label">Contact Number</label>
                    <input type="text" name="contactno" id="Contactnumber" class="form-control rounded-pill" required>
                </div>
                </div>

                <div class="row mb-3">
                <div class="col-md-6">
                    <label for="branchID" class="form-label">Branch</label>
                    <select name="branch_id" id="BranchiD" class="form-select rounded-pill" required>
                    <option value="" default></option>
                        <?php
                        // This query joins branch with district to get names
                        $stmt = $conn->query("SELECT b.BranchId, b.BranchName, b.DistrictId, d.DistrictName 
                                            FROM t_branch b
                                            JOIN t_district d ON b.DistrictId = d.DistrictId");

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . $row['BranchId'] . '" data-district="' . $row['DistrictId'] . '">' .
                                    $row['BranchName'] . ' (' . $row['DistrictName'] . ')' .
                                '</option>';
                        }
                        ?>
                    </select>
                    <input type="hidden" name="district_id" id="district_id">
                </div>
                <div class="col-md-6">
                    <label for="role" class="form-label">Role</label>
                    <select name="role_id" id="role" class="form-control rounded-pill" rows="3">
                        <option value="" default></option>
                        <!--?php 
                        $stmt = $conn->query("SELECT r.RoleName 
                                                    FROM t_roles 
                                                    WHERE RoleId == 4");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . $row['RoleId'] . '">' . $row['RoleName'] . '</option>';
                        }
                        ?>-->
                    </select>
                </div>
                </div>
                
                <div class="row mb-3" id="admin_fields" style="display:none;">
                    <div class="col-md-6">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" name="position" id="Position" class="form-control rounded-pill">
                    </div>
                    <div class="col-md-6">
                        <label for="department" class="form-label">Department</label>
                        <input type="text" name="department" id="Department" class="form-control rounded-pill">
                    </div>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Register LIC</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Successful Creation Modal -->
    <div class="modal" id="successfulCreateModal" tabindex="-1" aria-labelledby="successfulCreateModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <i class="fa-regular fa-check-circle md-icon"></i>
                <h1>Successfully Added an Account!</h1>
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

    <script>
    const branchSelect = document.querySelector('select[name="branch_id"]');
    const districtInput = document.getElementById('district_id');

    if (branchSelect) {
    branchSelect.addEventListener('change', function () {
        const selectedOption = branchSelect.options[branchSelect.selectedIndex];
        const districtId = selectedOption.getAttribute('data-district');
        districtInput.value = districtId;
    });
    }

    document.querySelector('select[name="role_id"]').addEventListener('change', function () {
    if (this.value == "1") {
        document.getElementById('admin_fields').style.display = 'block';
    } else {
        document.getElementById('admin_fields').style.display = 'none';
    }
    });

    // Modal closing
    document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('successModal');
    var span = document.querySelector('.modal .close');

    if (span) {
        span.onclick = function () {
        modal.style.display = "none";
        }
    }

    window.onclick = function (event) {
        if (event.target == modal) {
        modal.style.display = "none";
        }
    }
    });
    </script>

<script>
    document.querySelector('select[name="role_id"]').addEventListener('change', function () {
        if (this.value == 1) {
            document.getElementById('admin_fields').style.display = 'block';
        } else {
            document.getElementById('admin_fields').style.display = 'none';
        }
    });
</script>