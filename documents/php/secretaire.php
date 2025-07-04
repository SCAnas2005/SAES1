<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    init_php_session();

    if (!is_logged())  // Vérifie que l'utilisateur est connecté, sinon redirige vers la page d'accueil
    {
        header("Location: /");
    }

    include_once "php/doc_secretaire.php";

    $data = Database::get_stage_and_docs_from_all_students();  // Récupération des données des stages et documents de tous les étudiants via la base de données

    $grouped = [];

    // echo "<pre>"; print_r($data); exit;



    $last_doc_ids = []; 

    foreach ($data as $row) {
        $id = $row['id'];
        $type = $row['type_document'] ?? null;
        $doc_id = isset($row['id_Document']) ? intval($row['id_Document']) : null;

        if (!isset($grouped[$id])) { // Si l'étudiant n'a pas encore été ajouté dans le tableau groupé, on l'initialise
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
                'documents' => [ // initialisation des documents à "non envoyé"
                    0 => [
                        "type_document" => "bordereau",
                        "statut" => "Non envoyé"
                    ],
                    1 => [
                        "type_document" => "convention",
                        "statut" => "Non envoyé"
                    ],
                ],
            ];
        }

        if ($doc_id && in_array($type, ['bordereau', 'convention'])) { // Si un document existe et son type est bordereau ou convention
            $index = $type === 'bordereau' ? 0 : 1;

            if (  // Si on n'a pas encore mémorisé cet id de document ou si l'id actuel est plus récent (plus grand)
                !isset($last_doc_ids[$id][$type]) ||
                $doc_id > $last_doc_ids[$id][$type]
            ) {
                $last_doc_ids[$id][$type] = $doc_id;

                $grouped[$id]['documents'][$index] = [
                    'id_Document' => $doc_id,
                    'type_document' => $type,
                    'chemin_fichier' => $index === 0
                        ? get_bordereau_filepath_from_student($id)
                        : get_convention_filepath_from_student($id),
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
                <th>Stage validé</th> <!-- 👈 Nouvelle colonne -->
                <th>Actions</th>
            </tr>

            <?php foreach ($students as $info_student): ?>
                <tr>
                    <td><?= htmlspecialchars($info_student["student"]["prenom"] . " " . $info_student["student"]["nom"]) ?></td>
                    
                    <td>
                        <span class="status <?= get_statut_classname_from_status($info_student["documents"][0]["statut"]) ?>">
                            <?= get_sec_status_from_student_status($info_student["documents"][0]["statut"]) ?>
                        </span>
                    </td>

                    <td>
                        <span class="status <?= get_statut_classname_from_status($info_student["documents"][1]["statut"]) ?>">
                            <?= get_sec_status_from_student_status($info_student["documents"][1]["statut"]) ?>
                        </span>
                    </td>

                    <td>
                        <?= $info_student["stage"]["valide"] ? "✅" : "❌" ?>
                    </td>

                    <td>
                        <a href="<?= L_DOCUMENTS_FOLDER . "/etudiant/index.php?id=" . $info_student["student"]["id"] ?>" class="btn-link">Gérer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>


    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>
</body>
</html>
