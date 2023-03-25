document.addEventListener('DOMContentLoaded', function() {
    const logoutElement = document.querySelector("#logout");
    const logoutMobile = document.querySelector("#logoutMobile");

    logoutElement.addEventListener("click", handleLogout);
    if(logoutMobile) {
        logoutMobile.addEventListener("click", handleLogout);
    }
    function handleLogout() {
        document.cookie = 'id_user=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;'
        location.reload();
    }
});
