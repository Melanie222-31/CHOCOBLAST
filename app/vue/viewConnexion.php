<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/style/main.css">
    <script src="./public/script/script.js" defer></script>
    <title>Connexion</title>
</head>
<body>
    <!-- // import menu -->
    <?php include './app/vue/viewMenu.php';?>
    <h3>Se connecter</h3>
    <div class="form">
        <form action="" method="post">
            <label for="mail_utilisateur">Saisir votre mail :</label>
            <input type="text" name="mail_utilisateur">
            <label for="password_utilisateur">Saisir votre mot de passe :</label>
            <input type="password" name="password_utilisateur">
            <input type="submit" value="Connexion" name="submit">
        </form>
        <div id="error"><?php echo $msg; ?></div>
        <div id="valide"><?php echo $valide; ?></div>
    </div>
</body>
</html>