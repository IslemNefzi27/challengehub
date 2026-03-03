// Attendre que le DOM soit chargé (Pratique courante en intégration)
document.addEventListener('DOMContentLoaded', function() {

    // 1. Confirmation avant de voter (Ergonomie)
    // On récupère tous les liens qui contiennent l'action "vote"
    const voteLinks = document.querySelectorAll('a[href*="action=vote"]');

    voteLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            // Affichage d'une boîte de dialogue simple
            const confirmation = confirm("Voulez-vous confirmer votre vote pour cette participation ?");
            
            // Si l'utilisateur clique sur "Annuler", on bloque le lien
            if (!confirmation) {
                event.preventDefault();
            }
        });
    });

    // 2. Mise en évidence des lignes du classement au survol (Feedback visuel)
    const tableRows = document.querySelectorAll('tr');
    
    tableRows.forEach(function(row) {
        row.addEventListener('mouseover', function() {
            // On change légèrement l'opacité au survol
            this.style.cursor = 'pointer';
        });
    });

    // 3. Gestion des messages d'erreur (si présents)
    // Permet de faire disparaître les alertes après 3 secondes
    const alerts = document.querySelectorAll('.alert');
    if (alerts.length > 0) {
        setTimeout(function() {
            alerts.forEach(function(alert) {
                alert.style.display = 'none';
            });
        }, 3000);
    }
});