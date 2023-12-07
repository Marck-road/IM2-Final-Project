function submitForm() {
    document.getElementById("filterForm").submit();
}

function approve(){
    document.getElementById(modalId).style.display = 'none';
    
    var openModal = modalId + 'apply';

    document.getElementById(openModal).style.display = 'block';

}