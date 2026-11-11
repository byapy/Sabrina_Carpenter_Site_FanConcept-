"use strict";
window.gsap.registerPlugin(window.ScrollTrigger, window.ScrollSmoother);
const smoother = window.ScrollSmoother.create({
    wrapper: "#smooth-wrapper",
    content: "#smooth-content",
    smooth: 1.5,
    effects: true,
    smoothTouch: 0.1
});
export {};
//# sourceMappingURL=smoother.js.map