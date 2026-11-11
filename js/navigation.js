"use strict";
document.querySelectorAll(".main-nav").forEach((nav) => {
    const toggle = nav.querySelector(".menu-toggle");
    const links = nav.querySelectorAll(".main-nav-link");
    if (!toggle) {
        return;
    }
    const closeMenu = () => {
        nav.classList.remove("is-open");
        toggle.setAttribute("aria-expanded", "false");
        toggle.setAttribute("aria-label", "Open navigation menu");
    };
    toggle.addEventListener("click", () => {
        const isOpen = nav.classList.toggle("is-open");
        toggle.setAttribute("aria-expanded", String(isOpen));
        toggle.setAttribute("aria-label", isOpen ? "Close navigation menu" : "Open navigation menu");
    });
    links.forEach((link) => {
        link.addEventListener("click", closeMenu);
    });
    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape") {
            closeMenu();
        }
    });
});
//# sourceMappingURL=navigation.js.map