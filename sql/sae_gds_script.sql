CREATE TABLE TypeAction(
   id_TypeAction INT PRIMARY KEY,
   libellé VARCHAR(50),
   Executant INT,
   Destinataire VARCHAR(50),
   delaiEnJours DATE,
   ReferenceDélai VARCHAR(50),
   requiertDoc BOOLEAN,
   LienModeleDoc VARCHAR(50)
);

CREATE TABLE Utilisateur(
   id INT,
   nom VARCHAR(50),
   prenom VARCHAR(50),
   email VARCHAR(50),
   telephone VARCHAR,
   login VARCHAR(50),
   motdepasse VARCHAR(50),
   PRIMARY KEY(id),
   UNIQUE(nom),
   UNIQUE(prenom),
   UNIQUE(email),
   UNIQUE(login)
);
INSERT INTO Utilisateur
VALUES (2, "Rudiger", "Marc", "marc.rudiger@gmail.com", "0601020305", "none", "$2y$10$7c9cXb3inJRjjppunEoa7eOnuxnIewaeuhk.17SiPsx8t7buqZ796");
VALUES (1, "Audibert", "Laurent", "laurent.audibert@univ-paris13.fr", "0601020304", "12301163", "$2y$10$7c9cXb3inJRjjppunEoa7eOnuxnIewaeuhk.17SiPsx8t7buqZ796");

CREATE TABLE Entreprise(
   id_Entreprise INT,
   addresse VARCHAR(50),
   code_postal INT,
   villle VARCHAR(50),
   indicationVisite VARCHAR(50),
   tel INT,
   PRIMARY KEY(id_Entreprise)
);

INSERT INTO Entreprise
VALUES (0, "5 rue des tulipes", "75000", "Paris", "", "0102030405");

CREATE TABLE Tuteur_entreprise(
   id INT,
   id_Entreprise INT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id) REFERENCES Utilisateur(id),
   FOREIGN KEY(id_Entreprise) REFERENCES Entreprise(id_Entreprise)
);

INSERT INTO Tuteur_entreprise 
VALUES (2, 0);

CREATE TABLE Etudiant(
   id INT,
   id_enseignant INT,
   PRIMARY KEY(id),
   FOREIGN KEY(id) REFERENCES Utilisateur(id)
   FOREIGN KEY(id) REFERENCES Enseignant(id_enseignantw)
);


select * from Utilisateur 


CREATE TABLE Secretaire(
   id INT,
   Bureau VARCHAR(50),
   PRIMARY KEY(id),
   FOREIGN KEY(id) REFERENCES Utilisateur(id)
);

CREATE TABLE Enseignant(
   id INT,
   id_etudiant INT, 
   Bureau VARCHAR(50),
   PRIMARY KEY(id),
   FOREIGN KEY(id) REFERENCES Utilisateur(id)
);

CREATE TABLE Administrateur(
   id INT,
   PRIMARY KEY(id),
   FOREIGN KEY(id) REFERENCES Utilisateur(id)
);

CREATE TABLE annne(
   annne INT,
   PRIMARY KEY(annne)
);

CREATE TABLE Departement(
   id_Departement INT,
   Libellé VARCHAR(50),
   id INT NOT NULL,
   PRIMARY KEY(id_Departement),
   UNIQUE(id),
   UNIQUE(Libellé),
   FOREIGN KEY(id) REFERENCES Enseignant(id)
);

CREATE TABLE Semestre(
   id_Departement INT,
   numSemestre INT,
   id INT NOT NULL,
   annne INT NOT NULL,
   PRIMARY KEY(id_Departement, numSemestre),
   UNIQUE(id),
   FOREIGN KEY(id_Departement) REFERENCES Departement(id_Departement),
   FOREIGN KEY(id) REFERENCES Enseignant(id),
   FOREIGN KEY(annne) REFERENCES annne(annne)
);
INSERT INTO Semestre
VALUES (0, 1, 0, 2025);


CREATE TABLE Inscription(
   id_Departement INT,
   numSemestre INT,
   id INT,
   annne INT,
   PRIMARY KEY(id_Departement, numSemestre, id, annne),
   FOREIGN KEY(id_Departement, numSemestre) REFERENCES Semestre(id_Departement, numSemestre),
   FOREIGN KEY(id) REFERENCES Etudiant(id),
   FOREIGN KEY(annne) REFERENCES annne(annne)
);

INSERT INTO Inscription
VALUES (0, 1, 0, 2025);

CREATE TABLE Stage(
   id_Departement INT,
   numSemestre INT,
   id INT,
   annne INT,
   id_Stage INT,
   date_debut DATE,
   date_fin DATE,
   mission VARCHAR(50),
   date_soutenance DATE,
   salle_soutenance VARCHAR(50),
   id_1 INT,
   id_2 INT NOT NULL,
   id_3 INT NOT NULL,
   PRIMARY KEY(id_Departement, numSemestre, id, annne, id_Stage),
   FOREIGN KEY(id_Departement, numSemestre, id, annne) REFERENCES Inscription(id_Departement, numSemestre, id, annne),
   FOREIGN KEY(id_1) REFERENCES Enseignant(id),
   FOREIGN KEY(id_2) REFERENCES Enseignant(id),
   FOREIGN KEY(id_3) REFERENCES Tuteur_entreprise(id)
);

INSERT INTO Stage
VALUES (0, 1, 0, 2025, 0, "2025-01-24", "2025-03-24", "Créer une application", "2025-04-01", "R201", 0, 0, 0);

CREATE TABLE Action(
   id_Departement INT,
   numSemestre INT,
   id INT,
   annne INT,
   id_Stage INT,
   id_Action VARCHAR(50),
   date_realisation DATE,
   lienDocument VARCHAR(50),
   id_TypeAction INT NOT NULL,
   id_1 INT NOT NULL,
   PRIMARY KEY(id_Departement, numSemestre, id, annne, id_Stage, id_Action),
   FOREIGN KEY(id_Departement, numSemestre, id, annne, id_Stage) REFERENCES Stage(id_Departement, numSemestre, id, annne, id_Stage),
   FOREIGN KEY(id_TypeAction) REFERENCES TypeAction(id_TypeAction),
   FOREIGN KEY(id_1) REFERENCES Utilisateur(id)
);

CREATE TABLE Intervient(
   id_Departement INT,
   id INT,
   spécialisé VARCHAR(50),
   PRIMARY KEY(id_Departement, id),
   FOREIGN KEY(id_Departement) REFERENCES Departement(id_Departement),
   FOREIGN KEY(id) REFERENCES Enseignant(id)
);

CREATE TABLE gere(
   id INT,
   id_Departement INT,
   numSemestre INT,
   PRIMARY KEY(id, id_Departement, numSemestre),
   FOREIGN KEY(id) REFERENCES Secretaire(id),
   FOREIGN KEY(id_Departement, numSemestre) REFERENCES Semestre(id_Departement, numSemestre)
);


