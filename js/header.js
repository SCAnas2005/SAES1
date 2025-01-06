document.addEventListener('DOMContentLoaded', function () {
    const navItems = document.querySelectorAll('.nav-item');
    const indicator = document.querySelector('.nav-indicator');

    function updateIndicator(element) {
        const rect = element.getBoundingClientRect();
        indicator.style.width = `${rect.width}px`;
        indicator.style.left = `${element.offsetLeft}px`;
    }

    navItems.forEach(item => {
        item.addEventListener('click', function () {
            // Mise à jour de l'indicateur
            updateIndicator(this);

            // Mettre à jour les classes actives
            navItems.forEach(item => item.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Initialisation de l'indicateur sur l'élément actif
    updateIndicator(document.querySelector('.nav-item.active'));
});
