document.addEventListener("DOMContentLoaded", function() {
    const toggleButton = document.querySelector(".navbar__toggle");
    const menu = document.querySelector(".navbar__menu");

    toggleButton.addEventListener("click", function() {
        menu.classList.toggle("navbar__menu--active");
    });
});
