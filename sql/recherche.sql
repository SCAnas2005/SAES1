SELECT
    e.id AS id,
    u.nom AS nom,
    u.prenom AS prenom,
    u.telephone as telephone,
    u.email as email,
    u.login as login,
    t1.nom AS nom_tuteur_enseignant_1,
    t1.prenom AS prenom_tuteur_enseignant_1,
    t1.email as email_tuteur_enseignant_1,
    t1.telephone as telephone_tuteur_enseignant_1,
    t2.nom AS nom_tuteur_enseignant_2,
    t2.prenom AS prenom_tuteur_enseignant_2,
    t2.email as email_tuteur_enseignant_2,
    t2.telephone as telephone_tuteur_enseignant_2,
    te.nom AS nom_tuteur_stage,
    te.prenom AS prenom_tuteur_stage,
    te.telephone as telephone_tuteur_stage,
    te.email as email_tuteur_stage,
    ent.nom as nom_entreprise,
    ent.adresse AS adresse_entreprise,
    ent.ville AS ville_entreprise,
    ent.tel AS telephone_entreprise,
    s.id_Stage, s.date_debut, s.date_fin, s.titre, s.date_soutenance, s.salle_soutenance
FROM
    Etudiant e
JOIN Utilisateur u ON e.id = u.id
JOIN Stage s ON e.id = s.id
JOIN Enseignant en1 ON s.id_1 = en1.id
JOIN Enseignant en2 ON s.id_2 = en2.id
JOIN Utilisateur t1 ON en1.id = t1.id
JOIN Utilisateur t2 ON en2.id = t2.id
JOIN Tuteur_entreprise tec ON s.id_3 = tec.id
JOIN Utilisateur te ON tec.id = te.id
JOIN Entreprise ent ON tec.id_Entreprise = ent.id_Entreprise
WHERE e.id = 1;



SELECT
    a.id_Action,
    a.date_realisation,
    a.lienDocument,
    ta.libelle AS type_action_libelle,
    ta.Executant,
    ta.Destinataire,
    ta.delaiEnJours,
    ta.ReferenceDelai,
    ta.requiertDoc,
    ta.LienModeleDoc
FROM
    Action a
JOIN
    TypeAction ta ON a.id_TypeAction = ta.id_TypeAction
WHERE
    a.id_1 = 1;










SELECT
  Utilisateur.id,
  Utilisateur.nom,
  Utilisateur.prenom
FROM
  Tuteur_entreprise
INNER JOIN
  Utilisateur ON Tuteur_entreprise.id = Utilisateur.id;



-- Tuteur de stages
SELECT 
    tuteur_entreprise.id AS tuteur_id,
    u.nom AS tuteur_nom,
    u.prenom AS tuteur_prenom,
    u.email AS tuteur_email,
    u.telephone AS tuteur_tel
FROM 
    Stage s
JOIN 
    Inscription i ON s.id_Departement = i.id_Departement 
                  AND s.numSemestre = i.numSemestre 
                  AND s.id = i.id 
                  AND s.annee = i.annee
JOIN 
    Tuteur_entreprise tuteur_entreprise ON s.id_3 = tuteur_entreprise.id
JOIN 
    Entreprise e ON tuteur_entreprise.id_Entreprise = e.id_Entreprise
JOIN 
    Utilisateur u ON u.id = e.id_Entreprise
WHERE 
    i.id = 1;  -- Remplacez '?' par l'ID de l'étudiant spécifique



-- Entreprise
SELECT 
    e.id_Entreprise AS entreprise_id,
    e.nom AS entreprise_nom,
    e.adresse AS entreprise_adresse,
    e.code_postal AS entreprise_code_postal,
    e.ville AS entreprise_ville,
    e.indicationVisite AS entreprise_indicationVisite,
    e.tel AS entreprise_tel
FROM 
    Stage s
JOIN 
    Inscription i ON s.id_Departement = i.id_Departement 
                  AND s.numSemestre = i.numSemestre 
                  AND s.id = i.id 
                  AND s.annee = i.annee
JOIN 
    Tuteur_entreprise tuteur_entreprise ON s.id_3 = tuteur_entreprise.id
JOIN 
    Entreprise e ON tuteur_entreprise.id_Entreprise = e.id_Entreprise
WHERE 
    i.id = 1 and s.id = 1;


-- tuteur pedago
SELECT 
    u.id AS tuteur_pedagogique_id,
    u.nom AS tuteur_pedagogique_nom,
    u.prenom AS tuteur_pedagogique_prenom,
    u.email AS tuteur_pedagogique_email,
    u.telephone AS tuteur_pedagogique_tel
FROM 
    Stage s
JOIN 
    Utilisateur u ON u.id = s.id_1
WHERE 
    s.id = 1;



-- jury
SELECT 
    e1.id AS enseignant_1_id,
    u1.nom AS enseignant_1_nom,
    u1.prenom AS enseignant_1_prenom,
    u1.email AS enseignant_1_email,
    u1.telephone AS enseignant_1_tel,
    e2.id AS enseignant_2_id,
    u2.nom AS enseignant_2_nom,
    u2.prenom AS enseignant_2_prenom,
    u2.email AS enseignant_2_email,
    u2.telephone AS enseignant_2_tel
FROM 
    Stage s
JOIN 
    Enseignant e1 ON e1.id = s.id_1
JOIN 
    Utilisateur u1 ON u1.id = e1.id
JOIN 
    Enseignant e2 ON e2.id = s.id_2
JOIN 
    Utilisateur u2 ON u2.id = e2.id
WHERE 
    s.id = 1;

-- TUTEUR =======================================================================================================================

--tuteur
SELECT 
    s.id_Stage AS stage_id,
    s.date_debut AS stage_date_debut,
    s.date_fin AS stage_date_fin,
    s.titre AS stage_titre,
    s.description AS stage_description,
    s.taches AS stage_taches,
    s.date_soutenance AS stage_date_soutenance,
    s.salle_soutenance AS stage_salle_soutenance
FROM 
    Stage s
JOIN 
    Tuteur_entreprise te ON s.id_3 = te.id_Entreprise
WHERE 
    te.id = ?;  



SELECT 
    s.id_Stage AS stage_id,
    s.date_debut AS stage_date_debut,
    s.date_fin AS stage_date_fin,
    s.titre AS stage_titre,
    s.description AS stage_description,
    s.taches AS stage_taches,
    s.date_soutenance AS stage_date_soutenance,
    s.salle_soutenance AS stage_salle_soutenance,
    e.id AS etudiant_id,
    u.nom AS etudiant_nom,
    u.prenom AS etudiant_prenom,
    u.email AS etudiant_email,
    u.telephone AS etudiant_telephone
FROM 
    Stage s
JOIN 
    Tuteur_entreprise te ON s.id_3 = te.id_Entreprise
JOIN 
    Inscription i ON s.id = i.id
JOIN 
    Etudiant e ON i.id = e.id
JOIN 
    Utilisateur u ON e.id = u.id
WHERE 
    s.id_Stage = 1;  
    