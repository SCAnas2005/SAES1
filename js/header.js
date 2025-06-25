// Attente que tout le contenu HTML soit chargé avant d'exécuter le script
document.addEventListener('DOMContentLoaded', function () {

    // Sélection de tous les éléments qui ont la classe 'nav-item'
    const navItems = document.querySelectorAll('.nav-item');

    // Sélection de l'élément qui servira d'indicateur visuel sous l'onglet actif
    const indicator = document.querySelector('.nav-indicator');

    /**
     * Fonction qui met à jour la position et la largeur de l'indicateur 
     * en fonction de l'élément passé en paramètre
     * @param {HTMLElement} element - L'élément sur lequel l'indicateur doit se positionner
     */
    function updateIndicator(element) {
        // Récupère les dimensions et la position relative de l'élément dans la fenêtre
        const rect = element.getBoundingClientRect();

        // Fixe la largeur de l'indicateur pour qu'elle corresponde à celle de l'élément ciblé
        indicator.style.width = `${rect.width}px`;

        // Positionne l'indicateur horizontalement au même emplacement que l'élément ciblé
        // offsetLeft est la distance entre l'élément et son parent positionné
        indicator.style.left = `${element.offsetLeft}px`;
    }

    // Ajoute un écouteur d'événement 'click' sur chacun des éléments de navigation
    navItems.forEach(item => {
        item.addEventListener('click', function () {
            // Lorsqu'un item est cliqué, met à jour la position de l'indicateur sur cet élément
            updateIndicator(this);

            // Supprime la classe 'active' de tous les éléments pour désactiver l'ancien onglet actif
            navItems.forEach(item => item.classList.remove('active'));

            // Ajoute la classe 'active' à l'élément cliqué pour le marquer comme actif
            this.classList.add('active');
        });
    });

    // Au chargement de la page, positionne l'indicateur sur l'élément déjà marqué comme actif (s'il y en a un)
    updateIndicator(document.querySelector('.nav-item.active'));
});
