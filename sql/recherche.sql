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
    s.id_Stage, s.date_debut, s.date_fin, s.mission, s.date_soutenance, s.salle_soutenance
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