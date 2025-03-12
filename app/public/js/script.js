document.addEventListener("DOMContentLoaded", () => {
    const toggleButton = document.querySelector(".navbar__toggle");
    const menu = document.querySelector(".navbar__menu");

    if (!toggleButton || !menu) return;

    toggleButton.addEventListener("click", (event) => {
        event.stopPropagation();
        menu.classList.toggle("navbar__menu--active");
    });

    document.addEventListener("click", (event) => {
        if (!menu.contains(event.target) && !toggleButton.contains(event.target)) {
            menu.classList.remove("navbar__menu--active");
        }
    });

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape") {
            menu.classList.remove("navbar__menu--active");
        }
    });
});
