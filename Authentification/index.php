<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/config/config.php";
    require_once ROOTPATH."/php/util.php";
    require DATABASE_FOLDER."/database.php";
    
    init_php_session();
    Database::init_database();

    if (isset($_SESSION["logged"]) and $_SESSION["logged"] == true)
    {
        header("Location: /");
    }

    $role = "";
    $incorect_password = null;
    if (isset($_POST["login"], $_POST["password"], $_POST["role"]))
    {
        $login = $_POST["login"];
        $password = $_POST["password"];
        $role = $_POST["role"];
        $user = Database::search_user($login, $role);
        // print_r($user);exit;
        if ($user == null or count($user) == 0 or !password_verify($password, $user["motdepasse"]))
        {
            $incorect_password = "Le login ou le mot de passe sont incorrect";
            $_SESSION["logged"] = false;
        }else{
            $_SESSION["usertype"] = $role;
            $_SESSION["real_usertype"] = $role;
            $_SESSION["logged"] = true;
            $_SESSION["data"]["userinfo"] = $user;
            if ($role == "tuteur_entreprise" or $role == "tuteur_pedagogique")
            {
                $_SESSION["usertype"] = "tuteur";
            }
            header("Location: /");
        }
    }

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href=<?= L_GLOBAL_CSS_FOLDER."/style.css" ?> rel="stylesheet">
    <link href="css/connexion.css" rel="stylesheet">
   
</head>
    <header>
        <h1>Suivi des Stages</h1>
        <img src=<?= L_ASSETS_FOLDER."/iut_logo.png" ?> alt="Logo IUT" class="logo"> <!-- Logo IUT ajouté ici -->
    </header>

<body>
    <div class="containerinscription">
        <form method="post">
            <div id="role-selection" <?= ($incorect_password != null) ? "class='hidden'" : ""  ?>>
                <h1>Bienvenue</h1>
                <p>Choisissez votre rôle pour continuer :</p>
                <button name="student" class="bouton-student" type="button" onclick="connexion('student')">Étudiant</button>
                <button name="prof" class="bouton-teacher" type="button" onclick="connexion('prof')">Enseignant</button>
                <!-- <button name="chef_dep" class="bouton-chef" type="button" onclick="connexion('chef_dep')">Chef de Département</button> -->
                <button name="tuteur_entreprise" class="bouton-tuteurent" type="button" onclick="connexion('tuteur_entreprise')">Tuteur entreprise</button>
                <button name="tuteur_pedagogique" class="bouton-tuteurpeda" type="button" onclick="connexion('tuteur_pedagogique')">Tuteur pédagogique</button>
                
                <p><strong>Pas encore de compte ? </strong> <a href=<?= L_SIGNUP_FOLDER ?>>Inscrivez-vous</a></p> 
            </div>

            <div id="student-login" <?= ($incorect_password == null) ? "class='hidden'" : ""  ?>>
                <h2>Connexion</h2>
                <input name="login" type="text" placeholder="login" required>
                <input name="password" type="password" placeholder="Mot de passe" required>
                <input type="hidden" id="role" name="role" value=<?= $role ?>>
                <?= ($incorect_password != null) ? "<p>$incorect_password</p>" : ""  ?>
                <button type="submit" class="submit-bouton">Se Connecter</button>
                <button type="button" class="bouton-return" onclick="retour()">Retour</button>
            </div>
        </form>
    </div>

    <?php require ROOTPATH."/php/footer.php";?>

    <script>
        function connexion(role) {
            event.preventDefault();
            document.getElementById('role-selection').classList.add('hidden');
            document.getElementById('student-login').classList.remove('hidden');
            document.getElementById('role').value = role; // Définir le rôle choisi
        }

        function retour() {
            document.getElementById('role-selection').classList.remove('hidden');
            document.getElementById('student-login').classList.add('hidden');
            document.getElementById('role').value = ""; // Définir le rôle choisi
        }
    </script>
</body>
</html>
