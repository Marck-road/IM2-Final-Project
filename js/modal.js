
function openModal(modalId, overlayId){
    document.getElementById(modalId).style.display = 'block';
    document.getElementById(overlayId).style.display = 'block';
}

function closeModal(modalId, overlayId) {
    document.getElementById(modalId).style.display = 'none';
    document.getElementById(overlayId).style.display = 'none';
}

function closeOpenModal(modalId, overlayId) {
    document.getElementById(modalId).style.display = 'none';
    
    var openModal = modalId + 'apply';

    document.getElementById(openModal).style.display = 'block';
}
