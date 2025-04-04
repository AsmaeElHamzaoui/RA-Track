<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | LimoWide</title>
</head>

<body>
    <div class="register-container">
        <!-- Formulaire d'inscription (à gauche) -->
        <form class="register-form" action="#" method="POST">
            <h2>Create Account</h2>
            <div class="inputBox">
                <input type="text" name="username" required="required">
                <i class="fa-regular fa-user"></i>
                <span>Username</span>
            </div>
            <div class="inputBox">
                <input type="email" name="email" required="required">
                <i class="fa-regular fa-envelope"></i>
                <span>Email Address</span>
            </div>
            <div class="inputBox">
                <input type="password" name="password" required="required">
                <i class="fa-solid fa-lock"></i>
                <span>Create Password</span>
            </div>
            <div class="inputBox">
                <input type="password" name="confirm_password" required="required">
                <i class="fa-solid fa-lock"></i>
                <span>Confirm Password</span>
            </div>
            <div class="inputBox">
                <input type="submit" value="Create Account">
            </div>
            <p>Already a member? <a href="/login">Log in</a></p>
        </form>
        
    </div>

</body>

</html>