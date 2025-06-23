<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    require_once DATABASE_FOLDER."/database.php";
    init_php_session();
    Database::init_database();
    
    
    if (!is_logged() || $_SESSION["usertype"] != "secretaire" || !isset($_GET["id"]))
    {
        header("Location: /");
    }
    
    include_once "../php/doc_secretaire.php";
    $id_student = $_GET["id"];

    $data = Database::get_stage_and_docs_from_student($id_student);
    // echo "<pre>";print_r($data);exit;

    $last_doc_id_bor = null;
    $last_doc_id_conv = null;
    foreach ($data as $row) {
        $id = $row['id'];

        if (!isset($grouped)) {
            $grouped = [
                'student' => [
                    'id' => $row['id'],
                    'nom' => $row['nom'],
                    'prenom' => $row['prenom'],
                    'email' => $row['email'],
                    'telephone' => $row['telephone'],
                ],
                'stage' => [
                    'id_Stage' => $row['id_Stage'],
                    'titre' => $row['titre'],
                    'date_debut' => $row['date_debut'],
                    'date_fin' => $row['date_fin'],
                    'valide' => $row['valide'],
                ],
                'documents' => [
                    [
                        "type_document" => "bordereau",
                        "statut" => "non-recu"
                    ],
                    [
                        "type_document" => "convention",
                        "statut" => "non-recu"
                    ]
                ],
            ];
        }

        if ($row['id_Document']) {
            $index = $row["type_document"] == "bordereau" ? 0 : 1;

            if ($row["type_document"] == "bordereau") {
                if ($last_doc_id_bor === null || $last_doc_id_bor < intval($row["id_Document"])) {
                    $last_doc_id_bor = intval($row["id_Document"]);
                    $grouped['documents'][$index] = [
                        'id_Document' => $row['id_Document'],
                        'type_document' => $row['type_document'],
                        'chemin_fichier' => get_bordereau_filepath_from_student($id_student),
                        'statut' => $row['statut'],
                        'date_derniere_action' => $row['date_derniere_action'],
                        'commentaire' => $row['commentaire'],
                    ];
                }
            } elseif ($row["type_document"] == "convention") {
                if ($last_doc_id_conv === null || $last_doc_id_conv < intval($row["id_Document"])) {
                    $last_doc_id_conv = intval($row["id_Document"]);
                    $grouped['documents'][$index] = [
                        'id_Document' => $row['id_Document'],
                        'type_document' => $row['type_document'],
                        'chemin_fichier' => get_convention_filepath_from_student($id_student),
                        'statut' => $row['statut'],
                        'date_derniere_action' => $row['date_derniere_action'],
                        'commentaire' => $row['commentaire'],
                    ];
                }
            }
        }
    }

    $student_info = $grouped;
    // echo "<pre>";print_r($student_info);exit;


    if (isset($_POST["download_bordereau"]))
    {
        $_SESSION["download_bordereau"] = $_POST["download_bordereau"];
        header("Location: ". L_DOCUMENTS_FOLDER."/php/download_sec.php");
    }

    if (isset($_POST["download_convention"])){
        $_SESSION["download_convention"] = $_POST["download_convention"];
        header("Location: ".L_DOCUMENTS_FOLDER."/php/download_sec.php");
    }

    if (isset($_POST["valide_bordereau"]))
    {
        if ($student_info["documents"][0]["statut"] != "valide")
        {
            Database::add_stage_document($id_student, $student_info["stage"]["id_Stage"], "bordereau", "", "valide", "");
            header("Location: ./");
        }
    }

    if (isset($_POST["valide_convention"]))
    {
        if ($student_info["documents"][1]["statut"] != "valide")
        {
            Database::add_stage_document($id_student, $student_info["stage"]["id_Stage"], "convention", "", "valide", "");
            header("Location: ./");
        }
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Étudiant - Stage</title>
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <link href=<?= L_DOCUMENTS_FOLDER."/etudiant/css/style.css" ?> rel="stylesheet">
</head>
<body>

  <?php require ROOTPATH."/php/header.php"; ?>


  <main>
    <h2>Gestion des Documents - <?= $student_info["student"]["prenom"]." ".$student_info["student"]["nom"] ?></h2>

    <!-- Bordereau Section -->
    <div class="doc-section">
        <h3>Bordereau</h3>
        <?php $bordereau = $student_info["documents"][0]; ?>
        <p>Statut : <span class="status <?= get_statut_classname_from_status($bordereau["statut"]) ?>"><?= get_sec_status_from_student_status($bordereau["statut"]) ?></span></p>

        <div class="actions">
            <?php if ($bordereau["statut"] !== "non-recu"): ?>
                <form method="post">
                    <button type="submit" name="download_bordereau" value="<?= $bordereau["chemin_fichier"] ?>" class="form-button">📥 Télécharger</button>
                </form>
            <?php endif; ?>

            <form action="<?= L_DOCUMENTS_FOLDER."/php/upload_bordereau.php" ?>" method="post" enctype="multipart/form-data" style="display: inline;">
                <input type="hidden" name="id_student" value="<?= $student_info["student"]["id"] ?>">
                <input type="hidden" name="id_stage" value="<?= $student_info["stage"]["id_Stage"] ?>">
                <input type="file" name="bordereau" style="display: none;" onchange="this.form.submit()" id="upload_bordereau">
                <label for="upload_bordereau" class="upload-button">📤 Envoyer le bordereau</label>
            </form>

            <?php if ($bordereau["statut"] === "attente"): ?>
                <form method="post">
                    <button name="valide_bordereau">✅ Valider Bordereau</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- Convention Section -->
    <div class="doc-section">
        <h3>Convention de Stage</h3>
        <?php $convention = $student_info["documents"][1]; ?>
        <p>Statut : <span class="status <?= get_statut_classname_from_status($convention["statut"]) ?>"><?= get_sec_status_from_student_status($convention["statut"]) ?></span></p>

        <div class="actions">
            <?php if ($convention["statut"] !== "non-recu"): ?>
                <form method="post">
                    <button type="submit" name="download_convention" value="<?= $convention["chemin_fichier"] ?>" class="form-button">📥 Télécharger</button>
                </form>
            <?php endif; ?>

            <form action="<?= L_DOCUMENTS_FOLDER."/php/upload_convention.php" ?>" method="post" enctype="multipart/form-data" style="display: inline;">
                <input type="hidden" name="id_student" value="<?= $student_info["student"]["id"] ?>">
                <input type="hidden" name="id_stage" value="<?= $student_info["stage"]["id_Stage"] ?>">
                <input type="file" name="convention" style="display: none;" onchange="this.form.submit()" id="upload_convention">
                <label for="upload_convention" class="upload-button">📤 Envoyer la convention</label>
            </form>

            <?php if ($convention["statut"] === "attente"): ?>
                <form method="post">
                    <button name="valide_convention">✅ Valider la convention</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- Validation Finale -->
    <div class="validation">
        <button>🎓 Valider le Stage</button>
    </div>
    </main>


<?php require ROOTPATH."/php/footer.php"; ?>

</body>
</html>
