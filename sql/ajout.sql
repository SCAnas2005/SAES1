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





INSERT INTO typeaction
VALUES
  (2, 'Prise de contact entreprise', 1, 'tuteur entreprise', 14, 'Début du stage', 0, NULL),
  (3, 'Planification de la soutenance', 1, 'jury', 21, 'Début du stage', 0, NULL),
  (4, 'Dépôt du rapport de stage', 1, 'tuteur entreprise-jury', 14, 'Début du stage', 1, NULL);




INSERT INTO Inscription
VALUES (1, 1, id, 2025);

INSERT INTO Stage (id_Departement, numSemestre, id, annee, date_debut, date_fin, titre, description, taches, date_soutenance, salle_soutenance, id_1, id_2, id_3)
VALUES (1, 1, 1, 2025, date_debut, date_fin, titre, description, taches, date_soutenance, salle_soutenance, tuteur_enseignant_1, tuteur_enseignant_2, tuteur_stage);

INSERT INTO Action (id_Departement, numSemestre, id, anne, id_Stage, date_realisation, id_1)
VALUES(1, 1, id, 2025, id_stage, date_realisation, 1, id),
      (1, 1, id, 2025, id_stage, date_realisation, 2, id),
      (1, 1, id, 2025, id_stage, date_realisation, 3, id),
      (1, 1, id, 2025, id_stage, date_realisation, 4, id);




-- Ajouter un étudiant
INSERT INTO Utilisateur (nom, prenom, email, telephone, login, motdepasse)
VALUES ('Dupont', 'Jean', 'jean.dupont@example.com', '0601020306', 'jean_dupont', SHA2('motdepasse', 256));
SET @last_user_id = LAST_INSERT_ID();
INSERT INTO Etudiant (last_user_id)
VALUES (@last_user_id);


-- AJOUTER un prof
INSERT INTO Utilisateur (nom, prenom, email, telephone, login, motdepasse)
VALUES ('Dupont', 'Jean', 'jean.dupont@example.com', '0601020306', 'jean_dupont', SHA2('motdepasse', 256));
SET @last_user_id = LAST_INSERT_ID();
INSERT INTO Enseignant (id, Bureau)
VALUES (@last_user_id, "R202");

-- Tuteur d'entreprise
INSERT INTO Utilisateur (nom, prenom, email, telephone, login, motdepasse)
VALUES ('Dupont', 'Jean', 'jean.dupont@example.com', '0601020306', 'jean_dupont', SHA2('motdepasse', 256));
SET @last_user_id = LAST_INSERT_ID();
INSERT INTO Enseignant (id, Bureau)
VALUES (@last_user_id, "R202");








-- PROFESSEURS
-- Exemple pour un professeur
-- INSERT INTO Utilisateur(...) VALUES (...);
-- INSERT INTO Enseignant(id, Bureau, id_Departement) VALUES (LAST_INSERT_ID(), 'R205', 1);

INSERT INTO Utilisateur(nom, prenom, email, login, motdepasse)
VALUES ('Finta', 'Lucian', 'lucian.finta@univ-paris13.fr', 'lucian.finta', 'lucian');
INSERT INTO Enseignant(id, Bureau, id_Departement) VALUES (LAST_INSERT_ID(), 'R205', 1);

INSERT INTO Utilisateur(nom, prenom, email, login, motdepasse)
VALUES ('Audibert', 'Laurent', 'laurent.audibert@univ-paris13.fr', 'laurent.audibert', 'laurent');
INSERT INTO Enseignant(id, Bureau, id_Departement) VALUES (LAST_INSERT_ID(), 'Q102', 1);

INSERT INTO Utilisateur(nom, prenom, email, login, motdepasse)
VALUES ('Dubacq', 'Jean-Christophe', 'jean-christophe.dubacq@univ-paris13.fr', 'jean-christophe.dubacq', 'jean-christophe');
INSERT INTO Enseignant(id, Bureau, id_Departement) VALUES (LAST_INSERT_ID(), 'S201', 1);

INSERT INTO Utilisateur(nom, prenom, email, login, motdepasse)
VALUES ('Lemaire', 'Bouchaib', 'bouchaib.lemaire@univ-paris13.fr', 'bouchaib.lemaire', 'bouchaib');
INSERT INTO Enseignant(id, Bureau, id_Departement) VALUES (LAST_INSERT_ID(), 'P120', 1);

INSERT INTO Utilisateur(nom, prenom, email, login, motdepasse)
VALUES ('Osmani', 'Aomar', 'aomar.osmani@univ-paris13.fr', 'aomar.osmani', 'aomar');
INSERT INTO Enseignant(id, Bureau, id_Departement) VALUES (LAST_INSERT_ID(), 'L111', 1);

INSERT INTO Utilisateur(nom, prenom, email, login, motdepasse)
VALUES ('Bouthinion', 'Alain', 'bouthinon@univ-paris13.fr', 'alain.bouthinion', 'alain');
INSERT INTO Enseignant(id, Bureau, id_Departement) VALUES (LAST_INSERT_ID(), 'R214', 1);

INSERT INTO Utilisateur(nom, prenom, email, login, motdepasse)
VALUES ('Hébert', 'Thierry', 'hebertiut@gmail.com', 'thierry.hebert', 'thierry');
INSERT INTO Enseignant(id, Bureau, id_Departement) VALUES (LAST_INSERT_ID(), 'Q132', 1);

INSERT INTO Utilisateur(nom, prenom, email, login, motdepasse)
VALUES ('Bosc', 'Marcel', 'marcel.bosc@univ-paris13.fr', 'marcel.bosc', 'marcel');
INSERT INTO Enseignant(id, Bureau, id_Departement) VALUES (LAST_INSERT_ID(), 'S118', 1);

INSERT INTO Utilisateur(nom, prenom, email, login, motdepasse)
VALUES ('Bacher', 'Eric', 'bacher@lipn.fr', 'eric.bacher', 'eric');
INSERT INTO Enseignant(id, Bureau, id_Departement) VALUES (LAST_INSERT_ID(), 'R208', 1);

INSERT INTO Utilisateur(nom, prenom, email, login, motdepasse)
VALUES ('Gerard', 'Pierre', 'pierre.gerard@univ-paris13.fr', 'pierre.gerard', 'pierre');
INSERT INTO Enseignant(id, Bureau, id_Departement) VALUES (LAST_INSERT_ID(), 'T103', 1);




-- ETUDIANTS
-- Étudiant 11
INSERT INTO utilisateur (nom, prenom, email, telephone, login, motdepasse)
VALUES ('Garcia', 'Tom', 'tom.garcia@example.com', '0611122233', 'tom.garcia', 'tom');
INSERT INTO Etudiant (id, id_Departement) VALUES (LAST_INSERT_ID(), 2);

-- Étudiant 12
INSERT INTO utilisateur (nom, prenom, email, telephone, login, motdepasse)
VALUES ('Lopez', 'Sarah', 'sarah.lopez@example.com', '0622233344', 'sarah.lopez', 'sarah');
INSERT INTO Etudiant (id, id_Departement) VALUES (LAST_INSERT_ID(), 4);

-- Étudiant 13
INSERT INTO utilisateur (nom, prenom, email, telephone, login, motdepasse)
VALUES ('Roux', 'Nathan', 'nathan.roux@example.com', '0633344455', 'nathan.roux', 'nathan');
INSERT INTO Etudiant (id, id_Departement) VALUES (LAST_INSERT_ID(), 3);

-- Étudiant 14
INSERT INTO utilisateur (nom, prenom, email, telephone, login, motdepasse)
VALUES ('Fournier', 'Clara', 'clara.fournier@example.com', '0644455566', 'clara.fournier', 'clara');
INSERT INTO Etudiant (id, id_Departement) VALUES (LAST_INSERT_ID(), 2);

-- Étudiant 15
INSERT INTO utilisateur (nom, prenom, email, telephone, login, motdepasse)
VALUES ('Girard', 'Ethan', 'ethan.girard@example.com', '0655566677', 'ethan.girard', 'ethan');
INSERT INTO Etudiant (id, id_Departement) VALUES (LAST_INSERT_ID(), 3);

-- Étudiant 16
INSERT INTO utilisateur (nom, prenom, email, telephone, login, motdepasse)
VALUES ('Andre', 'Camille', 'camille.andre@example.com', '0666677788', 'camille.andre', 'camille');
INSERT INTO Etudiant (id, id_Departement) VALUES (LAST_INSERT_ID(), 4);

-- Étudiant 17
INSERT INTO utilisateur (nom, prenom, email, telephone, login, motdepasse)
VALUES ('Lemoine', 'Adam', 'adam.lemoine@example.com', '0677788899', 'adam.lemoine', 'adam');
INSERT INTO Etudiant (id, id_Departement) VALUES (LAST_INSERT_ID(), 2);

-- Étudiant 18
INSERT INTO utilisateur (nom, prenom, email, telephone, login, motdepasse)
VALUES ('Noel', 'Ines', 'ines.noel@example.com', '0688899900', 'ines.noel', 'ines');
INSERT INTO Etudiant (id, id_Departement) VALUES (LAST_INSERT_ID(), 3);

-- Étudiant 19
INSERT INTO utilisateur (nom, prenom, email, telephone, login, motdepasse)
VALUES ('Meunier', 'Leo', 'leo.meunier@example.com', '0699900011', 'leo.meunier', 'leo');
INSERT INTO Etudiant (id, id_Departement) VALUES (LAST_INSERT_ID(), 4);

-- Étudiant 20
INSERT INTO utilisateur (nom, prenom, email, telephone, login, motdepasse)
VALUES ('Gauthier', 'Anna', 'anna.gauthier@example.com', '0612341122', 'anna.gauthier', 'anna');
INSERT INTO Etudiant (id, id_Departement) VALUES (LAST_INSERT_ID(), 3);

-- Étudiant 21
INSERT INTO utilisateur (nom, prenom, email, telephone, login, motdepasse)
VALUES ('Perrin', 'Mathis', 'mathis.perrin@example.com', '0623452233', 'mathis.perrin', 'mathis');
INSERT INTO Etudiant (id, id_Departement) VALUES (LAST_INSERT_ID(), 2);

-- Étudiant 22
INSERT INTO utilisateur (nom, prenom, email, telephone, login, motdepasse)
VALUES ('Marchand', 'Julie', 'julie.marchand@example.com', '0634563344', 'julie.marchand', 'julie');
INSERT INTO Etudiant (id, id_Departement) VALUES (LAST_INSERT_ID(), 4);

-- Étudiant 23
INSERT INTO utilisateur (nom, prenom, email, telephone, login, motdepasse)
VALUES ('Renard', 'Axel', 'axel.renard@example.com', '0645674455', 'axel.renard', 'axel');
INSERT INTO Etudiant (id, id_Departement) VALUES (LAST_INSERT_ID(), 3);

-- Étudiant 24
INSERT INTO utilisateur (nom, prenom, email, telephone, login, motdepasse)
VALUES ('Blanc', 'Laura', 'laura.blanc@example.com', '0656785566', 'laura.blanc', 'laura');
INSERT INTO Etudiant (id, id_Departement) VALUES (LAST_INSERT_ID(), 2);

-- Étudiant 25
INSERT INTO utilisateur (nom, prenom, email, telephone, login, motdepasse)
VALUES ('Roy', 'Maxime', 'maxime.roy@example.com', '0667896677', 'maxime.roy', 'maxime');
INSERT INTO Etudiant (id, id_Departement) VALUES (LAST_INSERT_ID(), 4);

-- Étudiant 26
INSERT INTO utilisateur (nom, prenom, email, telephone, login, motdepasse)
VALUES ('Guerin', 'Alice', 'alice.guerin@example.com', '0678907788', 'alice.guerin', 'alice');
INSERT INTO Etudiant (id, id_Departement) VALUES (LAST_INSERT_ID(), 3);

-- Étudiant 27
INSERT INTO utilisateur (nom, prenom, email, telephone, login, motdepasse)
VALUES ('Lemoine', 'Noe', 'noe.lemoine@example.com', '0689018899', 'noe.lemoine', 'noe');
INSERT INTO Etudiant (id, id_Departement) VALUES (LAST_INSERT_ID(), 2);

-- Étudiant 28
INSERT INTO utilisateur (nom, prenom, email, telephone, login, motdepasse)
VALUES ('Henry', 'Eva', 'eva.henry@example.com', '0690129900', 'eva.henry', 'eva');
INSERT INTO Etudiant (id, id_Departement) VALUES (LAST_INSERT_ID(), 3);

-- Étudiant 29
INSERT INTO utilisateur (nom, prenom, email, telephone, login, motdepasse)
VALUES ('Robin', 'Gabriel', 'gabriel.robin@example.com', '0611231011', 'gabriel.robin', 'gabriel');
INSERT INTO Etudiant (id, id_Departement) VALUES (LAST_INSERT_ID(), 4);

-- Étudiant 30
INSERT INTO utilisateur (nom, prenom, email, telephone, login, motdepasse)
VALUES ('Fabre', 'Lina', 'lina.fabre@example.com', '0622342122', 'lina.fabre', 'lina');
INSERT INTO Etudiant (id, id_Departement) VALUES (LAST_INSERT_ID(), 3);
