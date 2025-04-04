<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | LimoWide</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'navy': {
                            800: '#1a2e4c',
                        },
                    },
                }
            }
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>

    <div class="register-container">

        <!-- Formulaire de connexion (à gauche) -->
        <form class="register-form" action="#" method="POST">
            <h2>Login</h2>
            <div class="inputBox">
                <input type="email" name="email" required="required">
                <i class="fa-regular fa-envelope"></i>
                <span>Email Address</span>
            </div>
            <div class="inputBox">
                <input type="password" name="password" required="required">
                <i class="fa-solid fa-lock"></i>
                <span>Password</span>
            </div>
            <div class="inputBox">
                <input type="submit" value="Login">
            </div>
            <p>Not a member? <a href="/register">Create Account</a></p>
        </form>

        <!-- Section du Logo et Texte (à droite) -->
        <div class="logo-section">
            <img src="URL_DE_VOTRE_LOGO" alt="Logo LimoWide"> <!-- Remplacez par l'URL de votre logo -->
            <p>Bienvenue chez LimoWide. Connectez-vous pour accéder à votre compte!</p>
        </div>
    </div>

</body>

</html>