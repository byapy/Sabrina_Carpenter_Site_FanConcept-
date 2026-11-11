"use strict";

import type { gsap as Gsap } from "gsap";
import type { ScrollTrigger as ScrollTriggerPlugin } from "gsap/ScrollTrigger";
import type  { ScrollSmoother as ScrollSmootherPlugin } from "gsap/ScrollSmoother";

declare global {
    interface Window {
        gsap: typeof import("gsap").gsap;
        ScrollTrigger: typeof import("gsap/ScrollTrigger").ScrollTrigger;
        ScrollSmoother: typeof import("gsap/ScrollSmoother").ScrollSmoother;
    }
}


const smoother = window.ScrollSmoother.create({
    wrapper: "#smooth-wrapper",
    content: "#smooth-content",
    smooth: 1.5
});