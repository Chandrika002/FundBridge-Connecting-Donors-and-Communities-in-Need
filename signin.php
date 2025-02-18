<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <style>
    	/* General styles */
/* Style for form */
.sign-in-form {
    display: flex;
    flex-direction: column;
    gap: 10px;
    max-width: 400px;
    margin: 0 auto;
}
h1 {
    text-align: center;
    font-size: 2rem;
    margin-bottom: 20px;
    font-weight: bold;
    background: linear-gradient(45deg, #00695c, #009688, #4db6ac, #80cbc4);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Style for labels */
.sign-in-form label {
    font-size: 1rem;
    color: #333;
    font-weight: bold;
}

/* Style for inputs and select */
.sign-in-form input,
.sign-in-form select {
    width: 100%;
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Style for button */
.sign-in-form button {
    background-color: #00695c;
    color: white;
    padding: 10px;
    font-size: 1.2rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.sign-in-form button:hover {
    background-color: #004d40;
}

/* Style for sign-up link */
.sign-in-form p {
    text-align: center;
    margin-top: 10px;
}

.sign-in-form a {
    color: #00695c;
    text-decoration: none;
    font-weight: bold;
}

.sign-in-form a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>

    <div class="container">
        <h1>Sign In</h1>
        <form action="process_signin.php" method="POST" class="sign-in-form">
            <label for="role">Select Role:</label>
            <select name="role" id="role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required>

            <button type="submit">Sign In</button>
            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
        </form>
    </div>
</body>
</html>

