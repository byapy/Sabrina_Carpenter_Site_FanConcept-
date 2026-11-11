"use strict";
document.querySelectorAll(".main-nav").forEach((nav) => {
    const toggle = nav.querySelector(".menu-toggle");
    const links = nav.querySelectorAll(".main-nav-link");
    const menu = nav.querySelector(".nav-items-list");
    if (!toggle) {
        return;
    }
    gsap.fromTo(".nav-items-list", {
        x: -40,
        opacity: 0,
    }, {
        opacity: 1,
        x: 0
    });
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
export {};
//# sourceMappingURL=navigation.js.map