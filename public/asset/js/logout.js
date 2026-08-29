document.addEventListener('DOMContentLoaded', function () {
    const confirmLogoutBtn = document.getElementById('confirmLogoutBtn');

    if (confirmLogoutBtn) {
        confirmLogoutBtn.addEventListener('click', function () {
            document.getElementById('logout-form').submit();
            
            setTimeout(function() {
                window.location.href = logoutRedirectUrl; 
            }, 100);
        });
    }
});
