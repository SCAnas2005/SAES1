<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi des Stages - Tableau de Bord</title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/tableau_bord.css" rel="stylesheet">
</head>
<body>

    <?php require "header.php"; ?>

    <main class="main-content">
        <section class="section">
            <h2>Tableau de Bord</h2>
            <p>Bienvenue sur votre tableau de bord, où vous pouvez consulter les informations importantes concernant vos stages.</p>
        </section>

        <section class="section dashboard-summary">
            <div class="summary-box">
                <h3>Stages en cours</h3>
                <p>2 stages actifs</p>
                <span class="status">En cours</span>
            </div>
            <div class="summary-box">
                <h3>Documents envoyés</h3>
                <p>3 documents envoyés</p>
                <span class="status">Validés</span>
            </div>
            <div class="summary-box">
                <h3>Notifications récentes</h3>
                <p>3 notifications</p>
                <span class="status">Non lues</span>
            </div>
            <div class="summary-box">
                <h3>Prochaine échéance</h3>
                <p>Rapport de stage à soumettre</p>
                <span class="status">12 janvier 2025</span>
            </div>
        </section>

        <section class="section">
            <h2>Actions rapides</h2>
            <ul>
                <li><a href="voir_stages.html">Voir mes stages</a></li>
                <li><a href="deposer_document.html">Déposer un document</a></li>
                <li><a href="notifications.html">Voir mes notifications</a></li>
            </ul>
        </section>
    </main>

    <?php require "footer.php"; ?>
</body>
</html>
