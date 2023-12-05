
function openModal(modalId, overlayId){
    document.getElementById(modalId).style.display = 'block';
    document.getElementById(overlayId).style.display = 'block';
    // document.getElementById('infoModal').classList.add('active');
    // document.getElementById('overlay').classList.add('active');
}

function closeModal(modalId, overlayId) {
    document.getElementById(modalId).style.display = 'none';
    document.getElementById(overlayId).style.display = 'none';
    // document.getElementById('infoModal').classList.remove('active');
    // document.getElementById('overlay').classList.remove('active');
}

