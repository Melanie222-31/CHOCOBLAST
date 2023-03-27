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
    <section class="formContainer">
        <h3>Ajouter un compte utilisateur :</h3>
        <!-- Ajouter dans form la balise : 'enctype="multipart/form-data"' pour pouvoir afficher l'image, eviter fichier trop lourd mais tous les genre ok -->
        <form action="" method="post" enctype="multipart/form-data">
            <label for="nom_utilisateur">saisir votre nom :</label>
            <input type="text" name="nom_utilisateur">
            <label for="prenom_utilisateur">saisir votre prénom :</label>
            <input type="text" name="prenom_utilisateur">
            <label for="mail_utilisateur">saisir votre mail :</label>
            <input type="email" name="mail_utilisateur">
            <label for="password_utilisateur">saisir votre mot de passe :</label>
            <input type="password" name="password_utilisateur">
            <!-- Rajouter un imput pour ajouter la photo -->
            <label for="image_utilisateur"></label>
            <input type="file" name="image_utilisateur">
            <input type="submit" value="Ajouter" name="submit">
        </form>
    </section>
    <!-- Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p><?= $msg ?></p>
        </div>
    </div>
</body>
</html>