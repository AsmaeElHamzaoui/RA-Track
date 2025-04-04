<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | LimoWide</title>
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
    <style>
        /* CSS pour le formulaire */
        body {
            font-family: 'Poppins', sans-serif;
            /* Utilisation d'une image de fond */
            background-image: url('https://cdn.pixabay.com/photo/2023/02/03/23/48/airplane-7766082_1280.jpg');
            /* Remplacez par l'URL de votre image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #E0E0E0;
            /* Ajout d'une couleur de fond blanche cassée plus foncée */
        }

        /* Un overlay sombre pour améliorer la lisibilité si l'image de fond est claire */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 11, 61, 0.6);
            /* #0f0b3d avec transparence */
            z-index: -1;
            /* Placer derrière le contenu */
            display: none;
            /* On cache l'overlay */
        }

        .register-container {
            display: flex;
            width: 800px;
            max-width: 80%;
            background-color: rgba(22, 34, 56, 0.8);
            padding: 40px;
            border-radius: 20px;
            border: 1px solid rgba(255, 212, 118, 0.3);
            box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
            5px 5px 15px rgba(0, 0, 0, 0.35),
            inset -5px -5px 15px rgba(255, 255, 255, 0.1),
            inset 5px 5px 15px rgba(0, 0, 0, 0.35);
        }

        .register-container .logo-section {
            width: 50%; /* La moitié de la largeur */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            order: 2; /* Place la section logo à droite */
        }

        .register-container .logo-section img {
            max-width: 150px;
            margin-bottom: 20px;
        }

        .register-container .logo-section p {
            text-align: center;
            font-style: italic;
            font-size: 1.1em;
        }

        .register-form {
            width: 50%; /* La moitié de la largeur */
            display: flex;
            flex-direction: column;
            gap: 25px;
            align-items: center;
            order: 1; /* Place le formulaire à gauche */
        }

        .register-form h2 {
            color: #FFD476;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-align: center;
        }

        .inputBox {
            position: relative;
            width: 100%;
        }

        .inputBox input {
            padding: 12px 10px 12px 48px;
            border: none;
            width: 100%;
            background-color: #162238;
            border: 1px solid rgba(255, 212, 118, 0.1);
            color: #fff;
            font-weight: 300;
            border-radius: 25px;
            font-size: 1em;
            box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.05),
            5px 5px 15px rgba(0, 0, 0, 0.2);
            transition: 0.5s;
            outline: none;
        }

        .inputBox span {
            position: absolute;
            left: 0;
            padding: 12px 10px 12px 48px;
            pointer-events: none;
            font-size: 1em;
            font-weight: 300;
            transition: 0.5s;
            letter-spacing: 0.05em;
            color: rgba(255, 255, 255, 0.5);
        }

        .inputBox input:valid~span,
        .inputBox input:focus~span {
            color: #FFD476;
            border: 1px solid #FFD476;
            background: rgba(42, 37, 82, 0.7);
            transform: translateX(25px) translateY(-7px);
            font-size: 0.6em;
            padding: 0 8px;
            border-radius: 10px;
            letter-spacing: 0.1em;
        }

        .inputBox input:valid,
        .inputBox input:focus {
            border: 1px solid #FFD476;
        }

        .inputBox i {
            position: absolute;
            top: 15px;
            left: 16px;
            width: 25px;
            padding: 2px 0;
            padding-right: 8px;
            color: #FFD476;
            border-right: 1px solid #FFD476;
        }

        .inputBox input[type="submit"] {
            background: #FFD476;
            color: #162238;
            padding: 10px 0;
            font-weight: 500;
            cursor: pointer;
            box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
            5px 5px 15px rgba(0, 0, 0, 0.35),
            inset -5px -5px 15px rgba(255, 255, 255, 0.1),
            inset 5px 5px 15px rgba(0, 0, 0, 0.35);
            width: 100%;
        }

        .register-form p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.75em;
            font-weight: 300;
            text-align: center;
        }

        .register-form p a {
            font-weight: 500;
            color: #FFD476;
        }

        /* Fin du CSS */
    </style>
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
        

        <!-- Section du Logo et Texte (à droite) -->
        <div class="logo-section">
            <img src="URL_DE_VOTRE_LOGO" alt="Logo LimoWide"> <!-- Remplacez par l'URL de votre logo -->
            <p>Rejoignez LimoWide dès aujourd'hui et découvrez une nouvelle façon de voyager!</p>
        </div>

    </div>

</body>

</html>