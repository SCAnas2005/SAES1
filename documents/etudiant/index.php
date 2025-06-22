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

    $id_student = $_GET["id"];

    $data = Database::get_stage_and_docs_from_student($id_student);

    $last_doc_id = null;
    foreach ($data as $row) {
        $id = $row['id'];

        if (!isset($grouped[$id])) {
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
                    "statut" => "Non envoyé"
                    ],
                    [
                        "type_document" => "convention",
                        "statut" => "Non envoyé"
                    ]
                ],
            ];
        }

        if ($row['id_Document']) {
            $index = $row["type_document"] == "bordereau" ? 0 : 1;
            if ($last_doc_id != null)
            {
                if ($last_doc_id < intval($row["id_Document"]))
                {
                    echo $last_doc_id . "and".intval($row["id_Document"]);
                    $last_doc_id = $row["id_Document"];
                    $grouped['documents'][$index] = [
                        'id_Document' => $row['id_Document'],
                        'type_document' => $row['type_document'],
                        'chemin_fichier' => $row['chemin_fichier'],
                        'statut' => $row['statut'],
                        'date_derniere_action' => $row['date_derniere_action'],
                        'commentaire' => $row['commentaire'],
                    ];
                }   
            } else {
                $last_doc_id = $row["id_Document"];
                $grouped['documents'][$index] = [
                    'id_Document' => $row['id_Document'],
                    'type_document' => $row['type_document'],
                    'chemin_fichier' => $row['chemin_fichier'],
                    'statut' => $row['statut'],
                    'date_derniere_action' => $row['date_derniere_action'],
                    'commentaire' => $row['commentaire'],
                ];
            }
        } 

    }
    $student_info = $grouped;
    // echo "<pre>";print_r($student_info);exit;


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
      <p>Statut : <span class="status <?= get_statut_classname_from_status($student_info["documents"][0]["statut"]) ?>"><?= $student_info["documents"][0]["statut"] ?></span></p>
      <div class="actions">
        <a href="#">📥 Télécharger</a>
        <a href="#">👁️ Consulter</a>
        <button>📤 Envoyer un nouveau</button>
        <button>✅ Valider Bordereau</button>
      </div>
    </div>

    <!-- Convention Section -->
    <div class="doc-section">
      <h3>Convention de Stage</h3>
      <p>Statut : <span class="status non-recu">Non reçu</span></p>
      <div class="actions">
        <a href="#">📥 Télécharger</a>
        <a href="#">👁️ Consulter</a>
        <button>📤 Envoyer le bordereau</button>
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
