"use strict";

document.querySelectorAll<HTMLElement>(".main-nav").forEach((nav) => {
    const toggle = nav.querySelector<HTMLButtonElement>(".menu-toggle");
    const links = nav.querySelectorAll<HTMLAnchorElement>(".main-nav-link");

    if (!toggle) {
        return;
    }

    const closeMenu = (): void => {
        nav.classList.remove("is-open");
        toggle.setAttribute("aria-expanded", "false");
        toggle.setAttribute("aria-label", "Open navigation menu");
    };

    toggle.addEventListener("click", () => {
        const isOpen = nav.classList.toggle("is-open");

        toggle.setAttribute("aria-expanded", String(isOpen));
        toggle.setAttribute(
            "aria-label",
            isOpen ? "Close navigation menu" : "Open navigation menu"
        );
    });

    links.forEach((link) => {
        link.addEventListener("click", closeMenu);
    });

    document.addEventListener("keydown", (event: KeyboardEvent) => {
        if (event.key === "Escape") {
            closeMenu();
        }
    });
});
