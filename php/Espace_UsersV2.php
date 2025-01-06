
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon espace - Suivi des Stages</title>
    <link href="../css/style.css" rel="stylesheet">
   
</head>
<body>

    <?php require "header.php";?>

    <main class="main-content">
        <section class="profile-info">
            <img src="profile-placeholder.png" alt="Profil utilisateur">
            <div>
                <h2>Nom de l'utilisateur</h2>
                <p>Étudiant en informatique</p>
                <p>Département Informatique, IUT Villetaneuse</p>
            </div>
        </section>

        <section class="section">
            <h2>Mes Informations</h2>
            <p><strong>Email :</strong> utilisateur@iut.fr</p>
            <p><strong>Numéro étudiant :</strong> 123456789</p>
            <p><strong>Formation :</strong> Licence Informatique</p>
        </section>

        <section class="section">
            <h2>Mes Stages</h2>
            <p>Voici les détails de vos stages passés et à venir :</p>
            <ul>
                <li>Stage 1: Développement Web - Juin 2024</li>
                <li>Stage 2: Analyse de données - Décembre 2024</li>
            </ul>
        </section>

        <section class="profile-actions">
            <a href="#">Modifier mes informations</a>
            <a href="#">Voir mes évaluations</a>
            <a href="#">Se déconnecter</a>
        </section>
    </main>

    <?php require "footer.php"; ?>

</body>
</html>
