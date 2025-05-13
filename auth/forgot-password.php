<?php
// Start session
session_start();
include '../Includes/config.php';

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Generate a 6-digit OTP
    $otp = rand(100000, 999999);

    // Email content
    $subject = "Your OTP for QCPL Ticketing system Account Password Reset";
    $message = "Your One-Time Password (OTP) is: $otp\n\nPlease do not share this with anyone. It will expire in 5 minutes.";
    $headers = "From: aldehalseymeows@gmail.com";

    // Send mail
    if (mail($email, $subject, $message, $headers)) {
        // Optionally: Save OTP to session or database
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;
        $_SESSION['otp_expiry'] = time() + 300; // 5 mins

        // Redirect to OTP verification page
        header("Location: ../auth/verify-otp.php");
        exit();
    } else {
        echo "<script>
            alert('Failed to send OTP. Please try again later.');
            window.location.href = '../auth/forgot-password.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="icon" type="image/x-icon" href="asset/img/qcpl-sts-logo.png">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <!-- External CSS -->
    <link rel="stylesheet" href="../asset/css/forgot-pass.css"> 
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card">
            <div class="card-body">
                <div class="text-center mb-5 logo">
                    <img src="../asset/img/qcpl-sts-logo.png" alt="QCPL Logo" class="logo" width="80px">
                    <h3 class="text-center mt-0">QCPL STS</h3>
                    <h4 class="text-center mt-0">Forgot Password</h4>
                </div>
                <div id="error-message" class="alert alert-danger mt-3" style="display: none;"></div>
                
                <form method="POST"  id="forgot-password-form">
                    <div class="form-group">
                        <input type="email" class="form-control custom-input" id="email" name="email" placeholder="Enter Email Address" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Send OTP</button>
                </form>
                <div class="text-center mt-3">
                    <a href="index.php" class="links">Back to Login</a>
                </div>
            </div>
        </div>
    </div>

    <script src="../asset/js/reset-password.js"></script>
</body>


</html>