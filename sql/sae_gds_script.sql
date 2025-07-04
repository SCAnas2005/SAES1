CREATE TABLE Utilisateur (
   id INT AUTO_INCREMENT PRIMARY KEY,
   nom VARCHAR(50) ,
   prenom VARCHAR(50) ,
   email VARCHAR(50) ,
   telephone VARCHAR(20),
   login VARCHAR(50) UNIQUE,
   motdepasse VARCHAR(50)  
);

-- INSERT INTO Utilisateur (nom, prenom, email, telephone, login, motdepasse)
-- VALUES 
--    ('Rudiger', 'Marc', 'marc.rudiger@gmail.com', '0601020305', 'none', '$2y$10$7c9cXb3inJRjjppunEoa7eOnuxnIewaeuhk.17SiPsx8t7buqZ796'),
--    ('Audibert', 'Laurent', 'laurent.audibert@univ-paris13.fr', '0601020304', '12301163', '$2y$10$7c9cXb3inJRjjppunEoa7eOnuxnIewaeuhk.17SiPsx8t7buqZ796');

CREATE TABLE Entreprise (
   id_Entreprise INT AUTO_INCREMENT PRIMARY KEY,
   nom VARCHAR 50,
   adresse VARCHAR(50),
   code_postal INT,
   ville VARCHAR(50),
   indicationVisite VARCHAR(50),
   tel VARCHAR(20)
);

-- INSERT INTO Entreprise (adresse, code_postal, ville, indicationVisite, tel)
-- VALUES ('5 rue des tulipes', 75000, 'Paris', '', '0102030405');

CREATE TABLE Tuteur_entreprise (
   id INT AUTO_INCREMENT PRIMARY KEY,
   id_Entreprise INT NOT NULL,
   FOREIGN KEY (id_Entreprise) REFERENCES Entreprise(id_Entreprise)
);

-- INSERT INTO Tuteur_entreprise (id_Entreprise) 
-- VALUES (1);

CREATE TABLE Etudiant (
   id INT AUTO_INCREMENT PRIMARY KEY,
   FOREIGN KEY (id) REFERENCES Utilisateur(id)
);

CREATE TABLE Secretaire (
   id INT PRIMARY KEY AUTO_INCREMENT,
   Bureau VARCHAR(50),
   FOREIGN KEY (id) REFERENCES Utilisateur(id),
);

CREATE TABLE Enseignant (
   id INT AUTO_INCREMENT PRIMARY KEY,
   Bureau VARCHAR(50),
   FOREIGN KEY (id) REFERENCES Utilisateur(id)
);

CREATE TABLE Administrateur (
   id INT AUTO_INCREMENT PRIMARY KEY,
   FOREIGN KEY (id) REFERENCES Utilisateur(id)
);

CREATE TABLE Annee (
   annee INT PRIMARY KEY
);

   CREATE TABLE Departement (
      id_Departement INT AUTO_INCREMENT PRIMARY KEY,
      libelle VARCHAR(50) UNIQUE
   );

CREATE TABLE Semestre (
   id_Departement INT,
   numSemestre INT,
   id INT NOT NULL,
   annee INT NOT NULL,
   PRIMARY KEY (id_Departement, numSemestre)
);

-- INSERT INTO Semestre (id_Departement, numSemestre, id, annee)
-- VALUES (1, 1, 1, 2025);

CREATE TABLE Inscription (
   id_Departement INT,
   numSemestre INT,
   id INT,
   annee INT,
   PRIMARY KEY (id_Departement, numSemestre, id, annee),
   FOREIGN KEY (id_Departement, numSemestre) REFERENCES Semestre(id_Departement, numSemestre),
   FOREIGN KEY (id) REFERENCES Utilisateur(id),
   FOREIGN KEY (annee) REFERENCES Annee(annee)
);

INSERT INTO Inscription
VALUES (1, 1, id, 2025);

CREATE TABLE Stage (
   id_Departement INT,
   numSemestre INT,
   id INT,
   annee INT,
   id_Stage INT AUTO_INCREMENT PRIMARY KEY,
   date_debut DATE,
   date_fin DATE,
   titre VARCHAR(50),
   date_soutenance DATE,
   salle_soutenance VARCHAR(50),
   taches TEXT,
   description VARCHAR(100),
   id_1 INT,
   id_2 INT NOT NULL,
   id_3 INT NOT NULL,
   FOREIGN KEY (id_Departement, numSemestre, id, annee) REFERENCES Inscription(id_Departement, numSemestre, id, annee),
   FOREIGN KEY (id_1) REFERENCES Enseignant(id),
   FOREIGN KEY (id_2) REFERENCES Enseignant(id),
   FOREIGN KEY (id_3) REFERENCES Tuteur_entreprise(id)
);


INSERT INTO Stage (id_Departement, numSemestre, id, annee, date_debut, date_fin, titre, description, taches, date_soutenance, salle_soutenance, id_1, id_2, id_3)
VALUES (1, 1, 1, 2025, date_debut, date_fin, titre, description, taches, date_soutenance, salle_soutenance, tuteur_enseignant_1, tuteur_enseignant_2, tuteur_stage);



CREATE TABLE TypeAction (
   id_TypeAction INT AUTO_INCREMENT PRIMARY KEY,
   libelle VARCHAR(50),
   Executant INT,
   Destinataire VARCHAR(50),
   delaiEnJours INT,
   ReferenceDelai VARCHAR(50),
   requiertDoc BOOLEAN,
   LienModeleDoc VARCHAR(50)
);

CREATE TABLE Action (
   id_Departement INT,
   numSemestre INT,
   id INT,
   annee INT,
   id_Stage INT,
   id_Action INT AUTO_INCREMENT PRIMARY KEY,
   date_realisation DATE,
   lienDocument VARCHAR(50),
   id_TypeAction INT NOT NULL,
   id_1 INT NOT NULL,
   FOREIGN KEY (id_Stage) REFERENCES Stage(id_Stage),
   FOREIGN KEY (id_TypeAction) REFERENCES TypeAction(id_TypeAction),
   FOREIGN KEY (id_1) REFERENCES Utilisateur(id)
);

INSERT INTO Action (id_Departement, numSemestre, id, anne, id_Stage, date_realisation, id_1)
VALUES(1, 1, id, 2025, id_stage, date_realisation, 1, id),
      (1, 1, id, 2025, id_stage, date_realisation, 2, id),
      (1, 1, id, 2025, id_stage, date_realisation, 3, id),
      (1, 1, id, 2025, id_stage, date_realisation, 4, id);

CREATE TABLE Intervient (
   id_Departement INT,
   id INT,
   specialise VARCHAR(50),
   PRIMARY KEY (id_Departement, id),
   FOREIGN KEY (id_Departement) REFERENCES Departement(id_Departement),
   FOREIGN KEY (id) REFERENCES Enseignant(id)
);

CREATE TABLE Gere (
   id INT,
   id_Departement INT,
   numSemestre INT,
   PRIMARY KEY (id, id_Departement, numSemestre),
   FOREIGN KEY (id) REFERENCES Secretaire(id),
   FOREIGN KEY (id_Departement, numSemestre) REFERENCES Semestre(id_Departement, numSemestre)
);

CREATE TABLE StageCompetence (
   id_Stage INT,
   id_Competence INT,
   PRIMARY KEY(id_Stage, id_Competence),
   FOREIGN KEY(id_Stage) REFERENCES Stage(id_Stage),
   FOREIGN KEY(id_Competence) REFERENCES Competence(id_Competence)
):


CREATE TABLE Competence (
   id_Competence INT PRIMARY KEY AUTO_INCREMENT,
   titre VARCHAR(255)
);