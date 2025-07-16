<?php
session_start();
include '../Includes/config.php'; // Ensure this is included at the top

if (isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success_message'] . "</div>";
    unset($_SESSION['success_message']); // Remove the message after displaying
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCPL STS Register an IT</title>
    <link rel="icon" type="image/x-icon"  alt="qcpl_logo" href="asset/qcpl-logo.png">

    <!-- Link for Bootstrap -->
    <link href="../vendor/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../vendor/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CSS Link -->
    <link rel="stylesheet" href="forms.css">
  
    
</head>

<body>
    <div class="row align-items-center vh-100">
        <div class="col-5 mx-auto">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="text-center mb-5 logo">
                        <img src="asset/qcpl-logo.png" alt="Logo" class="logo" width="120px">
                        <p class="p-2 mb-5">QUEZON CITY PUBLIC LIBRARY</p>
                    </div>

                    <div id="error-message" class="alert alert-danger mt-3" style="display: none;"></div>

                    <!-- Updated form with action to register.php -->
                    <form action="../admin/register.php" method="POST" >
                    <label>First Name:</label>
                    <input type="text" name="first_name" required><br>
                    <label>Last Name:</label>
                    <input type="text" name="last_name" required><br>
                    <label>Email:</label>
                    <input type="email" name="email" required><br>
                    <label>Contact No:</label>
                    <input type="number" name="contactno" required><br>
                    <label>District ID:</label>
                    <input type="number" name="district_id" required><br>
                    <label>Branch ID:</label>
                    <input type="number" name="branch_id" required><br>
                    <label>Password:</label>
                    <input type="password" name="password" required><br>

                    <label>Role:</label>
                    <select name="role_id">
                        <option value="1">Admin</option>
                        <option value="2">BranchAdmin</option> 
                        <option value="3">ITstaff</option>
                        <option value="4"> UserEmp </option>


                    </select><br>

                    <div id="admin_fields" style="display:none;">
                        <label>Position:</label>
                        <input type="text" name="position"><br>
                        <label>Department:</label>
                        <input type="text" name="department"><br>
                    </div>

                    <button type="submit">Register</button>
                    </form>

    <script src="../assets/js/auth/admin/gen_login.js"></script>
</body>

<script>
    document.querySelector('select[name="role_id"]').addEventListener('change', function () {
        if (this.value == 1) {
            document.getElementById('admin_fields').style.display = 'block';
        } else {
            document.getElementById('admin_fields').style.display = 'none';
        }
    });
</script>

</body>
</html>