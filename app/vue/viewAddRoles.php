<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/style/main.css">
    <script src="./public/script/script.js" defer></script>
    <title>Add Roles</title>
</head>
<body>
    <!--import du menu -->
    <?php include './app/vue/viewMenu.php';?>
    <section class="formContainer">
    
    <h3>Ajouter un role :</h3>
    <form action="" method="post">
        <label for="nom_roles">Saisir un role :</label>
        <input type="text" name="nom_roles">
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