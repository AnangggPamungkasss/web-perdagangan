function togglePassword() {
    var passwordField = document.getElementById("password");
    var toggleIcon = document.getElementById("toggleIcon");

    if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.classList.remove('bi-eye-slash');
        toggleIcon.classList.add('bi-eye'); 
    } else {
        passwordField.type = "password";
        toggleIcon.classList.remove('bi-eye');
        toggleIcon.classList.add('bi-eye-slash');
    }
}