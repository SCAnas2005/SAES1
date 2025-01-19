
<?php 
    $docs = $_SESSION["user_docs"];
    if (isset($_POST["download"]))
    {
        $_SESSION["download_file"] = $_POST["download"];
        header("Location: ". L_DOCUMENTS_FOLDER."/php/download.php");
    }

    if (isset($_POST["remove"]))
    {
        $_SESSION["remove_file"] = $_POST["remove"];
        header("Location: ". L_DOCUMENTS_FOLDER."/php/remove.php");
    }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi des Stages - Gestion des Documents</title>
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <link href=<?= L_DOCUMENTS_FOLDER."/css/style.css" ?> rel="stylesheet">
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
            <form action=<?= L_DOCUMENTS_FOLDER."/php/upload.php" ?> method="post" enctype="multipart/form-data">
                <input type="file" class="form-input" name="document_upload" accept=".pdf,.docx,.doc,.odt,.rtf,.tex" required>
                <button type="submit" class="form-button">Importer</button>
            </form>
        </section>

        <section class="section document-list">
            <h3>Documents téléchargés</h3>
            <?php foreach ($docs as $doc):?>
                <div class="document-item">
                    <span><?= basename($doc) ?></span>
                    <div>
                        <form method="post">
                            <button type="submit" name="download" value=<?= $doc ?> class="form-button">Télécharger</button>
                            <button type="submit" name="remove" value="<?= $doc ?>" class="form-button"">Supprimer</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </main>

    <?php require ROOTPATH."/php/footer.php"; ?>
</body>
</html>
