"use strict";

declare global {
    interface Window {
        gsap: typeof import("gsap").gsap;
        ScrollTrigger: typeof import("gsap/ScrollTrigger").ScrollTrigger;
        ScrollSmoother: typeof import("gsap/ScrollSmoother").ScrollSmoother;
    }
}

window.gsap.registerPlugin(window.ScrollTrigger, window.ScrollSmoother);

const smoother = window.ScrollSmoother.create({
    wrapper: "#smooth-wrapper",
    content: "#smooth-content",
    smooth: 1.5,
    effects: true,
    smoothTouch: 0.1
});

export {};
