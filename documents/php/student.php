<?php 
    $docs = $_SESSION["user_docs"];

    
    if (isset($_POST["download"])) // Si un téléchargement est demandé via le formulaire POST
    {
        $_SESSION["download_file"] = $_POST["download"];  // On stocke le chemin du fichier à télécharger en session
        header("Location: ". L_DOCUMENTS_FOLDER."/php/download.php");
    }

    if (isset($_POST["remove"]))  // Si une suppression est demandée via POST
    {
        $_SESSION["remove_file"] = $_POST["remove"];  // On stocke le chemin du fichier à supprimer en session
        header("Location: ". L_DOCUMENTS_FOLDER."/php/remove.php");
    }

    unset($_SESSION["download_bordereau"]);
    unset($_SESSION["download_convention"]);
    if (isset($_POST["download_bordereau"])) // Si téléchargement du bordereau demandé
    {
        $_SESSION["download_bordereau"] = $_POST["download_bordereau"];
        header("Location: ". L_DOCUMENTS_FOLDER."/php/download_sec.php");
    }
    if (isset($_POST["download_convention"]))   // Si téléchargement de la convention demandé
    {
        $_SESSION["download_convention"] = $_POST["download_convention"];
        header("Location: ". L_DOCUMENTS_FOLDER."/php/download_sec.php");
    }

    $has_stage = $_SESSION["has_stage"];

    include_once "doc_secretaire.php";

    $data = Database::get_stage_and_docs_from_student($_SESSION["data"]["userinfo"]["id"]);
    $docs_secretaire = [ // Initialisation des documents de la secrétaire avec statut "non-reçu"
        [
            'type_document' => 'bordereau',
            'statut' => 'non-recu'
        ],
        [
            'type_document' => 'convention',
            'statut' => 'non-recu'
        ]
    ];
    // echo "<pre>"; print_r($data);exit;

    foreach ($data as $value) {
        if (isset($value["id_Document"]))
        {
            $index = $value["type_document"] == "bordereau" ? 0 : 1;
            $docs_secretaire[$index] = [
                'chemin_fichier' => $index == 0 ? get_bordereau_filepath_from_student($_SESSION["data"]["userinfo"]["id"]) : get_convention_filepath_from_student($_SESSION["data"]["userinfo"]["id"]),
                'type_document' => $value["type_document"],
                'statut' => $value["statut"]
            ];
        }
    }

    if ($has_stage)
        $stage_valide = $data[0]["valide"];
    // echo "<pre>"; print_r($data);exit;

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
    <?php if ($has_stage): ?>   
    <section class="section">
        <h2>Documents échangés avec la secrétaire</h2>
        <table class="document-table">
            <tr>
                <th>Type de document</th>
                <th>Statut</th>
                <th>Nom du fichier</th>
                <th>Envoyer un fichier</th>
                <th>Action</th>
            </tr>

            <?php
            $types = ['bordereau', 'convention'];
            foreach ($types as $type):
                $doc = null;
                foreach ($docs_secretaire as $d) {
                    if ($d['type_document'] === $type) {
                        $doc = $d;
                        break;
                    }
                }
            ?>
            <tr>
                <td><?= ucfirst($type) ?></td>
                <td><span class="status <?= $doc["statut"] ?>"><?= $doc ? $doc['statut'] : 'non-recu' ?></span></td>
                <td><?= $doc && isset($doc['chemin_fichier']) ? basename($doc['chemin_fichier']) : '-' ?></td>
                <td>
                    <?php if (!$stage_valide): ?>
                        <form action="<?= L_DOCUMENTS_FOLDER . ($doc["type_document"] == "bordereau" ? "/php/upload_bordereau.php" : "/php/upload_convention.php") ?>" method="post" enctype="multipart/form-data">
                            <input type="file" name="<?= ($doc["type_document"] == "bordereau" ? "bordereau" : "convention") ?>" accept=".pdf,.docx" required>
                            <input type="hidden" name="type_document" value="<?= $type ?>">
                            <button type="submit">Envoyer</button>
                        </form>
                    <?php else: ?>
                        <em>Envoi désactivé (stage validé)</em>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($doc && isset($doc['chemin_fichier'])): ?>
                        <form method="post">
                            <input type="hidden" name="<?= ($doc["type_document"] == "bordereau" ? "download_bordereau" : "download_convention") ?>" value="<?= $doc["chemin_fichier"] ?>">
                            <button type="submit" class="form-button">Télécharger</button>
                        </form>
                    <?php else: ?>
                        <em>—</em>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </section>


    <section class="section document-tuteur">
        <h2>Documents partagés avec le Tuteur</h2>
        <p>Dans cette section, vous pouvez consulter, envoyer ou supprimer des documents liés à votre stage.</p>

        <div class="upload-container">
            <h3>Importer un document pour le Tuteur</h3>
            <form action="<?= L_DOCUMENTS_FOLDER."/php/upload.php" ?>" method="post" enctype="multipart/form-data">
                <input type="file" class="form-input" name="document_upload" accept=".pdf,.docx,.doc,.odt,.rtf,.tex" required>
                <button type="submit" class="form-button">Importer</button>
            </form>
        </div>

        <div class="document-list">
            <h3>Documents téléchargés</h3>
            <?php if (!empty($docs)): ?>
                <?php foreach ($docs as $doc): ?>
                    <div class="document-item">
                        <span><?= basename($doc) ?></span>
                        <div>
                            <form method="post">
                                <button type="submit" name="download" value="<?= $doc ?>" class="form-button">Télécharger</button>
                                <button type="submit" name="remove" value="<?= $doc ?>" class="form-button">Supprimer</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun document téléchargé pour le moment.</p>
            <?php endif; ?>
        </div>
    </section>
<?php else: ?>
    <div class="no-stage-message" style="padding: 1.5em; text-align:center; background-color:#f8f8f8; border:1px solid #ddd; border-radius:8px; margin: 2em;">
        <h2>Aucun stage en cours</h2>
        <p>Vous n'avez actuellement aucun stage enregistré. <a href="<?= L_MES_STAGES_FOLDER ?>">Ajouter un nouveau stage</a></p>
    </div>
<?php endif; ?>
</main>


<?php require ROOTPATH."/php/footer.php"; ?>
</body>
</html>

