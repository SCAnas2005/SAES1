

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi des Stages - Gestion des Documents</title>
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <link href="css/student.css" rel="stylesheet">
</head>
<body>
<?php require ROOTPATH."/php/header.php"; ?>

    <main class="main-content">
        <section class="section">
            <h2>Gestion des Documents</h2>
            
            <div class="document-item">
            
                <p>Dans cet espace vous pouvez consultez et gérez les documents associés à vos stages. <br>
                Vous pouvez également télécharger de nouveaux documents.</p>
            
            </div>
        
        </section>

        <section class="section">
            <h3>Importer un document</h3>
            <form>
                <input type="file" class="form-input" name="document" accept=".pdf,.docx,.txt,.jpg,.png" required>
                <button type="submit" class="form-button">Importer</button>
            </form>
        </section>

        <section class="section document-list">
            <h3>Documents téléchargés</h3>
            <div class="document-item">
                <span>Rapport de Stage - Juin 2024</span>
                <div>
                    <button class="form-button" onclick="window.location.href='download-link'">Télécharger</button>
                    <button class="form-button" onclick="alert('Document supprimé')">Supprimer</button>
                </div>
            </div>
            <div class="document-item">
                <span>Convention de Stage - Décembre 2023</span>
                <div>
                    <button class="form-button" onclick="window.location.href='download-link'">Télécharger</button>
                    <button class="form-button" onclick="alert('Document supprimé')">Supprimer</button>
                </div>
            </div>
        </section>
    </main>

    <?php require ROOTPATH."/php/footer.php"; ?>
</body>
</html>
