<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .hidden-field {
            display: none;
        }
        .form-container {
            max-width: 700px;
            margin: 2rem auto;
            padding: 2rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #f9f9f9;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="form-container">
        <h2 class="text-center mb-4">Sign Up</h2>
        <form id="signup-form" action="process_signup.php" method="POST" class="signup-form">
        <div class="mb-3"> 
            <label for="userName" class="form-label">Full Name:</label>
            <input type="text" name="userName" id="userName" placeholder="Enter your full name" required><br>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" id="password" placeholder="Create your own password" required>
        </div>
        <!-- <div class="mb-3">
            <label for="retype_password" class="form-label">Password:</label>
            <input type="password" name="retype_password" id="retype_password" placeholder="Retype the password" required>
        </div> -->
        
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
        </div>
        <div class="mb-3">
            <label for="userAccountNumber">Account Number:</label>
            <input type="text" name="userAccountNumber" id="userAccountNumber" placeholder="Enter your account number" required>
        </div>
        <div class="mb-3">
            <label for="userType" class="form-label">User Type:</label>
            <select name="userType" id="userType" required>
                <!-- <option value="admin">Admin</option> -->
                <option value="individual">Individual</option>
                <option value="organization">Organization</option>
            </select>
        </div>
        
        <div class="text-center">
            <button type="submit" id="submit-button" class="btn btn-primary w-100">Sign Up</button>
        </div>
            <p class="text-center mt-3">Already have an account? <a href="signin.php">Sign In</a></p>
        </form>
    </div>

    <script>
        const password = document.getElementById("password");
        const confirmPassword = document.getElementById("confirmPassword");
        const submitButton = document.getElementById("submit-button");

        confirmPassword.addEventListener("input", () => {
            if (password.value === confirmPassword.value) {
                submitButton.disabled = false;
                submitButton.style.opacity = "1";
            } else {
                submitButton.disabled = true;
                submitButton.style.opacity = "0.5";
            }
        });
    </script>
</body>
</html>

