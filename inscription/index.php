<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    require DATABASE_FOLDER."/database.php";
    init_php_session();
    Database::init_database();

    $entreprises = Database::get_all_entreprises();

    $role = "";
    $used_login = null;
    $inscription_reussi = false;
    if (isset($_POST["login"], $_POST["password"], $_POST["role"]))
    {
        // echo "enfiiiiiiiiiiiiiiin";exit;
        $login = $_POST["login"];
        $password = $_POST["password"];
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $email = $_POST["email"];
        $tel = $_POST["tel"];
        $role = $_POST["role"];
        $infos = ["login"=>$login, "password"=>$password, "nom"=>$nom, "prenom"=>$prenom, "email"=>$email, "tel"=>$tel];
        if ($role == "tuteur_entreprise")
        {
            $choix_entreprise = $_POST["choix_entreprise"];
            $infos["choix_entreprise"] = $choix_entreprise;
        }
        
        $user = Database::search_user($login);
        if ($user)
        {
            $used_login = "Ce login est déjà utilisé";
        }else{
            Database::add_user($infos, $role);

            //return to connexion
            $inscription_reussi = true;
            header("Location: ".L_LOGIN_FOLDER);
        }
        
    }

    
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <link href="css/inscription.css" rel="stylesheet">
   
</head>


    <header>
        <h1>Suivi des Stages</h1>
        <img src=<?= L_ASSETS_FOLDER."/iut_logo.png" ?> alt="Logo IUT" class="logo"> <!-- Logo IUT ajouté ici -->
    </header>

<body>
    <div class="containerinscription">
        <?php if (!$inscription_reussi): ?>
            <form method="post">
                <div id="role-selection" <?= ($used_login != null) ? "class='hidden'" : ""  ?>>
                    <h1>Bienvenue, inscrivez-vous pour commencer</h1>
                    <p>Choisissez votre rôle pour continuer :</p>
                    <button name="student" class="bouton-student" type="button" onclick="connexion('student')">Étudiant</button>
                    <button name="prof" class="bouton-teacher" type="button" onclick="connexion('prof')">Enseignant</button>
                    <button name="chef_dep" class="bouton-chef" type="button" onclick="connexion('chef_dep')">Chef de Département</button>
                    <button name="tuteur_entreprise" class="bouton-tuteurent" type="button" onclick="connexion('tuteur_entreprise')">Tuteur entreprise</button>
                    <button name="tuteur_pedagogique" class="bouton-tuteurpeda" type="button" onclick="connexion('tuteur_pedagogique')">Tuteur pédagogique</button>
                    <p><a href=<?= L_LOGIN_FOLDER ?>>Se connecter</a></p> 
                </div>

                <div id="student-login" <?= ($used_login == null) ? "class='hidden'" : ""  ?>>
                    <h2>Inscription</h2>
                    <input name="nom" type="text" placeholder="Nom" required>
                    <input name="prenom" type="text" placeholder="Prénom" required>
                    <input name="email" type="email" placeholder="e-mail" required>
                    <input name="tel" type="text" placeholder="Téléphone" required>
                    <input name="login" type="text" placeholder="login" required>
                    <input name="password" type="password" placeholder="Mot de passe" required>
                    <select id="choix_entreprise" name="choix_entreprise" class="hidden" required>
                        <option value="a" disabled selected>Veuillez choisir une entreprise</option>
                        <?php foreach($entreprises as $entreprise): ?>
                            <option value=<?= $entreprise["id_Entreprise"] ?>><?= $entreprise["nom"] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" id="role" name="role" value='<?= $role ?>'>
                    <?= ($used_login != null) ? "<p>$used_login</p>" : "" ?>
                    <button type="submit" class="submit-bouton">S'inscrire</button>
                    <button type="button" class="bouton-return" onclick="retour()">Retour</button>
                </div>
            </form>
        <?php else: ?>
            <h1>Inscription réussie !</h1>
            <p><a href=<?= L_LOGIN_FOLDER ?>>Se connecter</a></p> 
        <?php endif; ?>
    </div>

    <?php require $_SESSION["PATHS"]["ROOTPATH"]."/php/footer.php";?>

    <script>
        function connexion(role) {
            event.preventDefault();
            document.getElementById('role-selection').classList.add('hidden');
            document.getElementById('student-login').classList.remove('hidden');
            document.getElementById('role').value = role; // Définir le rôle choisi
            if (role == "tuteur_entreprise")
            {
                document.getElementById('choix_entreprise').classList.remove('hidden');
            }else{
                document.getElementById('choix_entreprise').classList.add('hidden');
            }
        }

        function retour() {
            document.getElementById('role-selection').classList.remove('hidden');
            document.getElementById('student-login').classList.add('hidden');
        }
    </script>

</body>
</html>