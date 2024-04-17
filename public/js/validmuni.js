// assets/js/validmuni.js

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form'); // Replace 'your_form_id' with the actual ID of your form

    form.addEventListener('submit', function(event) {
        const nomMuniInput = form.querySelector('form.nomMuni'); // Replace 'your_form_id_nomMuni' with the actual ID of your 'nomMuni' input field
        const adresseMuniInput = form.querySelector('form.nomMuni'); // Replace 'your_form_id_adresseMuni' with the actual ID of your 'adresseMuni' input field

        if (!validateNomMuni(nomMuniInput.value)) {
            alert('Municipality name should only contain letters.');
            event.preventDefault(); // Prevent form submission
        }

    });

    function validateNomMuni(value) {
        // Validate municipality name (only letters allowed)
        return /^[a-zA-Z\s]+$/.test(value);
    }


});
