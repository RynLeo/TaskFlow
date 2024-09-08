document.addEventListener("DOMContentLoaded", function() {
    fetch('session_error_handler.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                const errorMessageDiv = document.getElementById('error-message');
                errorMessageDiv.textContent = data.error;
                errorMessageDiv.classList.remove('hidden');
            }
        });
});
