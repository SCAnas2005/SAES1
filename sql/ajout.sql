INSERT INTO Utilisateur (nom, prenom, email, telephone, login, motdepasse)
VALUES
    ('Rudiger', 'Marc', 'marc.rudiger@gmail.com', '0601020305', 'rudiger_marc', 'password1'),
    ('Audibert', 'Laurent', 'laurent.audibert@univ-paris13.fr', '0601020304', 'audibert_laurent', 'password2'),
    ('Dupont', 'Alice', 'alice.dupont@etu.univ.fr', '0601020301', 'alice_etu', 'password_hash'),
    ('Martin', 'Jean', 'jean.martin@univ.fr', '0601020302', 'jean_tuteur', 'password_hash'),
    ('Bernard', 'Paul', 'paul.bernard@company.com', '0601020303', 'paul_tuteur', 'password_hash');

INSERT INTO Entreprise (adresse, code_postal, ville, indicationVisite, tel)
VALUES
    ('5 rue des tulipes', 75000, 'Paris', '', '0102030405'),
    ('10 avenue de l\'Innovation', 75001, 'Paris', 'Prendre l\'ascenseur', '0102030406');

-- Peupler la table Tuteur_entreprise
INSERT INTO Tuteur_entreprise (id_Entreprise)
VALUES 
    (1),
    (2);

-- Peupler la table Etudiant
INSERT INTO Etudiant (id_enseignant)
VALUES
    (2),  -- Alice est suivie par Jean Martin
    (1);  -- Un autre étudiant, exemple de Jean

-- Peupler la table Secretaire
INSERT INTO Secretaire (Bureau)
VALUES
    ('Bureau 101'),
    ('Bureau 102');

-- Peupler la table Enseignant
INSERT INTO Enseignant (id_etudiant, Bureau)
VALUES
    (1, 'Bureau 202'),  -- Jean Martin
    (2, 'Bureau 203');  -- Laurent Audibert

-- Peupler la table Administrateur
INSERT INTO Administrateur 
VALUES
    (1);  -- Utilisateur avec ID 1 est un administrateur

-- Peupler la table Annee
INSERT INTO Annee (annee)
VALUES
    (2025),  -- Année académique 2025
    (2026);  -- Année académique 2026




-- Peupler la table Departement
INSERT INTO Departement (libelle, id)
VALUES
    ('Informatique', 1),
    ('Mathématiques', 2);

-- Peupler la table Semestre
INSERT INTO Semestre (id_Departement, numSemestre, id, annee)
VALUES
    (1, 1, 1, 2025),  -- Premier semestre pour le département informatique
    (2, 2, 2, 2025);  -- Deuxième semestre pour le département mathématiques



INSERT INTO Inscription (id_Departement, numSemestre, id, annee)
VALUES
    (1, 1, 1, 2025),  -- Étudiant 1 inscrit au semestre 1, département informatique
    (2, 2, 2, 2025);  -- Étudiant 2 inscrit au semestre 2, département mathématiques


INSERT INTO Stage (id_Departement, numSemestre, id, annee, date_debut, date_fin, mission, date_soutenance, salle_soutenance, id_1, id_2, id_3)
VALUES
    (1, 1, 1, 2025, "2025-01-24", "2025-03-24", "Création d'une application mobile", "2025-04-01", "R201", 1, 2, 1);




-- Peupler la table TypeAction
INSERT INTO TypeAction (libelle, Executant, Destinataire, delaiEnJours, ReferenceDelai, requiertDoc, LienModeleDoc)
VALUES
    ('Réunion', 1, 'Etudiant', 30, 'Soutenance', TRUE, 'modele_reunion.pdf'),
    ('Rendez-vous', 2, 'Enseignant', 15, 'Soutenance', FALSE, 'modele_rdv.pdf');


-- Peupler la table Action
INSERT INTO Action (id_Departement, numSemestre, id, annee, id_Stage, date_realisation, lienDocument, id_TypeAction, id_1)
VALUES
    (1, 1, 1, 2025, 1, '2025-01-30', 'action1.pdf', 1, 1),  -- Action pour le stage avec id_Stage = 1
    (1, 1, 1, 2025, 1, '2025-02-15', 'action2.pdf', 2, 2);  -- Action supplémentaire pour le stage avec id_Stage = 1

-- Peupler la table Intervient
INSERT INTO Intervient (id_Departement, id, specialise)
VALUES
    (1, 1, 'Algorithmique'),  -- Enseignant 1 spécialisé en algorithmique
    (2, 2, 'Analyse mathématique');  -- Enseignant 2 spécialisé en analyse mathématique

-- Peupler la table Gere
INSERT INTO Gere (id, id_Departement, numSemestre)
VALUES
    (1, 1, 1),  -- Secrétaire 1 gère le département informatique, semestre 1
    (2, 2, 2);  -- Secrétaire 2 gère le département mathématiques, semestre 2

