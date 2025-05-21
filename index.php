<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCPL STS Login</title>
    <link rel="icon" type="image/x-icon"  alt="qcpl_logo" href="asset/img/qcpl-sts-logo.png">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <!-- External CSS -->
    <link rel="stylesheet" href="../asset/css/login.css">
    <link rel="stylesheet" href="../asset/css/auxiliary-login.css">
    
</head>

<div class="overlay">
    <div class="container-fluid d-flex align-items-center justify-content-center vh-100">
        <div class="row login-container shadow-lg">
            <!-- Left Side: Image -->
            <div class="col-lg-6 d-none d-lg-block image-container">
                <h3 class="text-center mt-0">Quezon City Public Library</h3>
                <h4 class="text-center mt-1">Support Ticketing System</h4>
                <img src="asset/img/qclib1.png" class="img-fluid" alt="QCPL Main">
            </div>

            <!-- Right Side: Login Form -->
            <div class="col-lg-6 p-5 d-flex flex-column justify-content-center">
                <h2 class="mb-2"><span class="dot"></span> Log In</h2>
                <p class="text-muted">Welcome back! Please enter your credentials:</p>

                <form action="auth/login.php" method="POST" id="login-form">
                    <div class="mb-2">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control custom-input" id="email" name="email" placeholder="Enter your email address" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                        <input type="password" class="form-control custom-input" id="password-input" name="password" placeholder="Enter your password" required>
                            <span class="input-group-text custom-icon">
                                <i class="fa-solid fa-eye-slash" id="toggle-password" style="cursor: pointer;"></i>
                            </span>
                        </div>
                    </div>

                    <div class="text-center mt-2">
                        <button type="submit" class="btn btn-primary w-100 mt-3">Log in</button>
                    </div>

                    <div class="text-center mt-2">
                    <a href="auth/forgot-password.php" class="link-fp">Forgot Password?</a>
                    </div>

                    <div class="text-center mt-4">
                    <small style="font-size: 15px;">Don’t have an account? <a href="auth/login_error.php" class="link">Request here</a>.</small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('select[name="role_id"]').addEventListener('change', function () {
        if (this.value == 1) {
            document.getElementById('admin_fields').style.display = 'block';
        } else {
            document.getElementById('admin_fields').style.display = 'none';
        }
    });
</script>

<script>
    document.getElementById("toggle-password").addEventListener("click", function() {
    let passwordInput = document.getElementById("password-input");
    let icon = this;
    
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    } else {
        passwordInput.type = "password";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    }
    });
</script>
</body>
</html>
