function validateForm() {
    let isValid = true;

    // Clear previous error messages
    document.querySelectorAll('.error').forEach(error => error.innerHTML = '');

    // Get form values
    const firstName = document.getElementById('first-name').value.trim();
    const lastName = document.getElementById('last-name').value.trim();
    const email = document.getElementById('email').value.trim();
    const phoneNumber = document.getElementById('phone-number').value.trim();
    const password = document.getElementById('password').value.trim();
    const confirmPassword = document.getElementById('confirm-password').value.trim();

    // Regular expression for alphabetic characters only (a-z or A-Z)
    const namePattern = /^[a-zA-Z]+$/;

    // Validate first name
    if (!firstName) {
        document.getElementById('firstNameError').innerHTML = 'First name is required.';
        isValid = false;
    } else if (!namePattern.test(firstName)) {
        document.getElementById('firstNameError').innerHTML = 'First name must contain only alphabetic characters.';
        isValid = false;
    }

    // Validate last name only if input is provided
    if (lastName && !namePattern.test(lastName)) {
        document.getElementById('lastNameError').innerHTML = 'Last name must contain only alphabetic characters.';
        isValid = false;
    }

    // Validate email
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email) {
        document.getElementById('emailError').innerHTML = 'Email is required.';
        isValid = false;
    } else if (!emailPattern.test(email)) {
        document.getElementById('emailError').innerHTML = 'Please enter a valid email address.';
        isValid = false;
    }

    // Validate phone number (optional, but must be 10 digits if entered)
    const phonePattern = /^\d{10}$/;
    if (phoneNumber && !phonePattern.test(phoneNumber)) {
        document.getElementById('phoneError').innerHTML = 'Phone number must be 10 digits.';
        isValid = false;
    }

    // Validate password
    // const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,8}$/;
    // if (!password) {
    //     document.getElementById('passwordError').innerHTML = 'Password is required.';
    //     isValid = false;
    // } else if (!passwordPattern.test(password)) {
    //     document.getElementById('passwordError').innerHTML = 'Password must be 6-8 characters long, contain an uppercase letter, a lowercase letter, a digit, and a special character.';
    //     isValid = false;
    // }

    // Validate confirm password
    // if (confirmPassword !== password) {
    //     document.getElementById('confirmPasswordError').innerHTML = 'Passwords do not match.';
    //     isValid = false;
    // }

    // If the form is valid, show the success message
    if (isValid) {
        alert('Form submitted successfully!');
        return true; // Allow form submission
    }

    // Prevent form submission if invalid
    return false;
}
