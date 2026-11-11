"use strict";
import type { gsap as Gsap } from "gsap";
import type { Flip as FlipPlugin } from "gsap/Flip";

declare global {
    interface Window {
        gsap: typeof Gsap;
        Flip: typeof FlipPlugin;
    }
}

document.querySelectorAll<HTMLElement>(".main-nav").forEach((nav) => {
    const toggle = nav.querySelector<HTMLButtonElement>(".menu-toggle");
    const links = nav.querySelectorAll<HTMLAnchorElement>(".main-nav-link");
    const menu = nav.querySelector<HTMLElement>(".nav-items-list");

    if (!toggle) {
        return;
    }
    gsap.fromTo(".nav-items-list",{
        x: -40,
        opacity: 0,
    },{
        opacity: 1,
        x:0
    }
    );
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
