
function openModal(modalId, overlayId){
    document.getElementById(modalId).style.display = 'block';
    document.getElementById(overlayId).style.display = 'block';
}

function openSuccessModal(modalId, overlayId){
    document.getElementById(modalId).style.display = 'flex';
    document.getElementById(overlayId).style.display = 'block';
}



function closeModal(modalId, overlayId) {
    document.getElementById(modalId).style.display = 'none';
    document.getElementById(overlayId).style.display = 'none';
}

function closeOpenModal(modalId, overlayId) {
    document.getElementById(modalId).style.display = 'none';
    document.getElementById(overlayId).style.display = 'none';
    var openModal = modalId + 'apply';
    var openOverlay = overlayId + 'apply';
    document.getElementById(openModal).style.display = 'block';
    document.getElementById(openOverlay).style.display = 'block';
}
