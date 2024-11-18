// script.js
document.getElementById('supportToggle').addEventListener('click', function() {
    var supportDetails = document.getElementById('supportDetails');
    if (supportDetails.style.display === 'none' || supportDetails.style.display === '') {
        supportDetails.style.display = 'block';
    } else {
        supportDetails.style.display = 'none';
    }
});
