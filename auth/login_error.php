<?php
session_start();
include '../Includes/config.php';

// Handle form submission
if (isset($_POST['request_account'])) {
    $user_email = htmlspecialchars($_POST['user_email']);
    $contact_no = htmlspecialchars($_POST['contact_no']);
    $account_type = $_POST['account_type'];
    $branch_id = $_POST['branch_id'] ?? null;

    if (!$branch_id) {
        $_SESSION['error_message'] = "Please select a branch.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Get branch details
    $stmt = $conn->prepare("SELECT b.BranchName, d.DistrictName FROM t_branch b JOIN t_district d ON b.DistrictId = d.DistrictId WHERE b.BranchId = ?");
    $stmt->execute([$branch_id]);
    $branch_info = $stmt->fetch(PDO::FETCH_ASSOC);

    $branch_name = $branch_info['BranchName'] ?? 'Unknown Branch';
    $district_name = $branch_info['DistrictName'] ?? 'Unknown District';

    if ($account_type === "employee") {
        // Get Branch Admin email
        $stmt = $conn->prepare("SELECT Email FROM t_users WHERE RoleId = 2 AND BranchId = ?");
        $stmt->execute([$branch_id]);
        $branch_admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($branch_admin) {
            $recipient_email = $branch_admin['Email'];
        } else {
            $_SESSION['error_message'] = "No branch admin found for the selected branch.";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }

        $subject = "Employee Account Request: QCPL STS";
        $message = "Hello Branch Admin,\n\nA user is requesting an employee account for QCPL STS.\n\nEmail: $user_email\nContact: $contact_no\nBranch: $branch_name\n\nPlease process this request accordingly.";
    } else {
        // Send to system admin for branchadmin or IT
        $recipient_email = "aldehalseymeows@gmail.com";
        $subject = strtoupper($account_type) . " Account Request: QCPL STS";
        $message = "Hello Admin,\n\nA user is requesting an account for QCPL STS.\n\nType: $account_type\nEmail: $user_email\nContact: $contact_no\nBranch: $branch_name\n\nPlease process accordingly.";
    }

    $headers = "From: noreply@qcplsts.com";

    if (mail($recipient_email, $subject, $message, $headers)) {
        $_SESSION['success_message'] = "Your request has been sent. Please wait for further instructions via email.";
    } else {
        $_SESSION['error_message'] = "Failed to send your request. Please try again later.";
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Account</title>
    <link rel="icon" type="image/x-icon" href="asset/img/qcpl-sts-logo.png">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <!-- External CSS -->
    <link rel="stylesheet" href="../asset/css/auxiliary-login.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card" style="width: 100%; max-width: 500px;">
            <div class="text-left mt-4">
                <a href="../index.php" class="link">
                    <i class="fa-solid fa-chevron-left" style="font-size: 14px;"></i> Back to Login
                </a>
            </div>
            <div class="card-body">
                <div class="text-center mt-2 logo rq-header">
                    <img src="../asset/img/qcpl-sts-logo.png" alt="QCPL Logo" class="logo" width="70px">
                    <h5 class="mt-3">QCPL STS</h5>
                    <h4 class="mt-0">Request an Account</h4>
                </div>

                <!-- Success & Error Message Alerts -->
                <?php
                if (isset($_SESSION['success_message'])) {
                    echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
                    unset($_SESSION['success_message']);
                }
                if (isset($_SESSION['error_message'])) {
                    echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
                    unset($_SESSION['error_message']);
                }
                ?>

                <!-- Request Account Form -->
                <form method="POST">
                    <div class="mb-3" id="user_email">
                        <label for="user_email" class="form-label">Email Address</label>
                        <input type="email" class="form-control custom-input" name="user_email" placeholder="Enter your email address" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="contact_no" class="form-label">Contact Number</label>
                            <input type="text" class="form-control custom-input" name="contact_no" placeholder="Enter your contact number"required>
                        </div>

                        <div class="col-md-6">
                            <label for="account_type" class="form-label">Account Type</label>
                            <select class="form-select custom-input" name="account_type" required>
                                <option value="-- Select Type --" default></option>
                                <option value="employee">Employee</option>
                                <option value="branchadmin">Branch Admin</option>
                                <option value="it">IT</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label for="branch_id" class="form-label">Branch</label>
                        <select class="form-select custom-input" name="branch_id" required>
                            <option value="-- Select Branch --" default></option>
                            <?php
                            $stmt = $conn->query("SELECT b.BranchId, b.BranchName, d.DistrictName 
                                                FROM t_branch b
                                                JOIN t_district d ON b.DistrictId = d.DistrictId");
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $row['BranchId'] . '">' .
                                    htmlspecialchars($row['BranchName']) . ' (' . htmlspecialchars($row['DistrictName']) . ')</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" name="request_account" class="btn btn-primary w-100 mt-2">Request Account</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>