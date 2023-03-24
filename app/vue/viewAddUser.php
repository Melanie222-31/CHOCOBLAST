<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/style/main.css">
    <script src="./public/script/script.js" defer></script>
    <title>Ajouter un utilisateur</title>
</head>
<body>
    <!-- // import menu -->
    <?php include './app/vue/viewMenu.php';?>
    <h3>Ajouter un compte utilisateur :</h3>
    <form action="" method="post">
        <label for="nom_utilisateur">Saisir votre nom :</label>
        <input type="text" name="nom_utilisateur">
        <label for="prenom_utilisateur">Saisir votre prénom :</label>
        <input type="text" name="prenom_utilisateur">
        <label for="mail_utilisateur">Saisir votre mail :</label>
        <input type="text" name="mail_utilisateur">
        <label for="password_utilisateur">Saisir votre mot de passe :</label>
        <input type="password" name="password_utilisateur">
        <input type="submit" value="Ajouter" name="submit">
    </form>
    <div id="error"><?php echo $msg; ?></div>
</body>
</html>