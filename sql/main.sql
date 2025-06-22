SELECT 
    s.*, 
    ds.id AS doc_id,
    ds.chemin_fichier, 
    ds.type, 
    ds.statut, 
    ds.date_envoi, 
    ds.date_validation,
    u.nom, 
    u.prenom, 
    u.email
FROM 
    Stage s
LEFT JOIN 
    DocumentStage ds ON s.id_Stage = ds.id_Stage
JOIN 
    Utilisateur u ON u.id = s.id_Etudiant
WHERE 
    s.id_Etudiant = 1;