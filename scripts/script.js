document.addEventListener("DOMContentLoaded", function () {
    if (window.location.hash) {
        history.replaceState(null, document.title, window.location.pathname);
    }
});

document.addEventListener("DOMContentLoaded", function () {
    window.addEventListener("scroll", function () {
        var navbar = document.getElementById("navbar-sticky");
        if (window.scrollY > 20) {
            navbar.classList.remove("navbar-container-pd");
            navbar.classList.add("navbar-container-bg");
        } else {
            navbar.classList.add("navbar-container-pd");
            navbar.classList.remove("navbar-container-bg");
        }
    });
});

function openStore() {
    window.open("store.html", "_blank");
    return;
}