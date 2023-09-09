function openModal() {
    var modal = document.getElementById('ticketModal');
    modal.style.display = 'block';
}

// Fonction pour masquer la modal
function closeModal() {
    var modal = document.getElementById('ticketModal');
    modal.style.display = 'none';
}

// Fermer la modal si l'utilisateur clique en dehors de la modal
window.onclick = function(event) {
    var modal = document.getElementById('ticketModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}