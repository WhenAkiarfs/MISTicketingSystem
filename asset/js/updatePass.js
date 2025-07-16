document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('new_password');
    const strengthText = document.getElementById('password-strength-text');

    if (!passwordInput || !strengthText) return;

    passwordInput.addEventListener('input', function () {
        const value = passwordInput.value;

        if (value === '') {
            strengthText.textContent = '';
            return;
        }

        const strength = getPasswordStrength(value);
        strengthText.textContent = strength.text;
        strengthText.style.color = strength.color;
    });

    function getPasswordStrength(password) {
        let strength = 0;

        if (password.length >= 6) strength++;
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;
        if (password.match(/[^a-zA-Z0-9]/)) strength++;

        if (strength <= 1) {
            return { text: 'Weak password', color: 'red' };
        } else if (strength === 2 || strength === 3) {
            return { text: 'Medium password', color: 'orange' };
        } else {
            return { text: 'Strong password', color: 'green' };
        }
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const newPasswordInput = document.getElementById('new_password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const mismatchError = document.getElementById('mismatch-error');

    function checkPasswordMatch() {
        if (confirmPasswordInput.value && newPasswordInput.value !== confirmPasswordInput.value) {
            mismatchError.textContent = "Passwords do not match.";
        } else {
            mismatchError.textContent = "";
        }
    }

    newPasswordInput.addEventListener('input', checkPasswordMatch);
    confirmPasswordInput.addEventListener('input', checkPasswordMatch);
});
