// Variable globale qui stocke l'identifiant de la section actuellement affichée
var current_section_id = "";

/**
 * Fonction pour afficher une section spécifique du contenu
 * et masquer la section précédemment affichée.
 * 
 * @param {string} sectionId - L'identifiant de la section à afficher.
 */
function showSection(sectionId) {
    // Si la section demandée est différente de celle déjà affichée
    if (current_section_id != sectionId)
    {
        // S'il y a une section actuellement affichée, on la masque
        if (current_section_id != "")
        {
            // Récupère l'élément HTML de la section affichée précédemment
            var selectedSection = document.getElementById(current_section_id);

            // Masque cette section en réglant son style display à 'none'
            selectedSection.style.display = 'none';

            // Récupère l'élément du menu de navigation correspondant à cette section
            var selectedNavSection = document.getElementById("nav_"+current_section_id);

            // Réinitialise le style de fond et arrondis les angles pour désactiver la sélection visuelle
            selectedNavSection.style.backgroundColor = "transparent";
            selectedNavSection.style.borderRadius = "5px";

            // Affiche dans la console l'identifiant de la navigation masquée (utile pour debug)
            console.log("nav_"+current_section_id);
        }
        
        // Récupère l'élément HTML de la nouvelle section à afficher
        selectedSection = document.getElementById(sectionId);

        // Rend visible la nouvelle section en réglant son display à 'block'
        selectedSection.style.display = 'block';

        // Récupère l'élément du menu de navigation correspondant à la nouvelle section
        selectedNavSection = document.getElementById("nav_"+sectionId);

        // Change le style du menu de navigation pour indiquer la section active (ex: couleur de fond)
        selectedNavSection.style.backgroundColor = " #ad947e";

        // Met à jour la variable globale pour garder en mémoire la section affichée
        current_section_id = sectionId;
    }
}

// Affiche par défaut la section "info" lors du chargement du script
showSection("info");
