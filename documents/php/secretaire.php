<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    init_php_session();

    if (!is_logged())
    {
        header("Location: /");
    }

    include_once "php/doc_secretaire.php";

    $data = Database::get_stage_and_docs_from_all_students();

    $grouped = [];

    // echo "<pre>"; print_r($data); exit;


    $last_doc_id = null;
    foreach ($data as $row) {
        $id = $row['id'];

        if (!isset($grouped[$id])) {
            $grouped[$id] = [
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
                    // echo $last_doc_id . "and".intval($row["id_Document"]);
                    $last_doc_id = $row["id_Document"];
                    $grouped[$id]['documents'][$index] = [
                        'id_Document' => $row['id_Document'],
                        'type_document' => $row['type_document'],
                        'chemin_fichier' => $index == 0 ? get_bordereau_filepath_from_student($id) : get_convention_filepath_from_student($id),
                        'statut' => $row['statut'],
                        'date_derniere_action' => $row['date_derniere_action'],
                        'commentaire' => $row['commentaire'],
                    ];
                }   
            } else {
                $last_doc_id = $row["id_Document"];
                $grouped[$id]['documents'][$index] = [
                    'id_Document' => $row['id_Document'],
                    'type_document' => $row['type_document'],
                    'chemin_fichier' => $index == 0 ? get_bordereau_filepath_from_student($id) : get_convention_filepath_from_student($id),
                    'statut' => $row['statut'],
                    'date_derniere_action' => $row['date_derniere_action'],
                    'commentaire' => $row['commentaire'],
                ];
            }
        } 
    }

    $students = $grouped;

    // echo "<pre>"; print_r($students); exit;

    // foreach ($students as &$student) {
    //     $bordereau = get_bordereau_filepath_from_student($student["student"]["id"]);
    //     $student["bordereau_status"] = "Non envoyé";

    // }
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi des Stages - Gestion des Documents</title>
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <link href="css/secretaire.css" rel="stylesheet">

</head>
<body>
    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/header.php";?>

    <main>
        <h2>Étudiants</h2>
        <table>
        <tr>
            <th>Nom</th>
            <th>Bordereau</th>
            <th>Convention</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($students as $info_student): ?>
            <tr>
                <td><?= $info_student["student"]["prenom"]." ".$info_student["student"]["nom"] ?></td>
                <td><span class="status <?= get_statut_classname_from_status($info_student["documents"][0]["statut"]) ?>">
                    <?= get_sec_status_from_student_status($info_student["documents"][0]["statut"]) ?>
                </span></td>
               <td><span class="status <?= get_statut_classname_from_status($info_student["documents"][1]["statut"]) ?>">
                    <?= get_sec_status_from_student_status($info_student["documents"][1]["statut"]) ?>
                </span></td>
                <td><a href="<?= L_DOCUMENTS_FOLDER."/etudiant/index.php?id=".$info_student["student"]["id"] ?>" class="btn-link">Gérer</a></td>
            </tr>
        <?php endforeach; ?>
        </table>
    </main>

    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
