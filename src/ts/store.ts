const cartLink = document.querySelector<HTMLAnchorElement>("#carritoICON");
const addToCartButtons = document.querySelectorAll<HTMLButtonElement>(".shop-item [name='add_to_cart']");

addToCartButtons.forEach((button) => {
    const form = button.closest<HTMLFormElement>("form");
    if (!form) return;

    form.addEventListener("submit", async (event) => {
        event.preventDefault();
        if (button.disabled) return;

        form.querySelector("[role='alert']")?.remove();
        const data = new FormData(form);
        data.set("add_to_cart", "1");
        button.disabled = true;

        try {
            const response = await fetch(form.action, {
                method: "POST",
                headers: { "X-Requested-With": "XMLHttpRequest" },
                body: data,
            });
            const result = await response.json();
            if (!response.ok || result.success !== true) {
                throw new Error(result.error || "We could not update your cart. Please try again.");
            }

            const product = button.closest<HTMLElement>(".shop-item");
            const image = product?.querySelector<HTMLImageElement>(".img-normal");

            if (!image || !cartLink) {
                return;
            }

            const imagePosition = image.getBoundingClientRect();
            const cartPosition = cartLink.getBoundingClientRect();
            const imageCopy = image.cloneNode(true) as HTMLImageElement;

            imageCopy.style.position = "fixed";
            imageCopy.style.left = `${imagePosition.left}px`;
            imageCopy.style.top = `${imagePosition.top}px`;
            imageCopy.style.width = `${imagePosition.width}px`;
            imageCopy.style.height = `${imagePosition.height}px`;
            imageCopy.style.zIndex = "1000";
            imageCopy.style.pointerEvents = "none";
            document.body.appendChild(imageCopy);

            try {
                // Explicit keyframes restart the flight even when the image is cached.
                const animation = imageCopy.animate([
                    { transform: "translate(0, 0) scale(1)", opacity: 1 },
                    {
                        transform: `translate(${cartPosition.left + cartPosition.width / 2 - imagePosition.left - imagePosition.width / 2}px, ${cartPosition.top + cartPosition.height / 2 - imagePosition.top - imagePosition.height / 2}px) scale(0.2)`,
                        opacity: 0.5,
                    },
                ], { duration: 700, easing: "ease", fill: "forwards" });
                await animation.finished;
            } finally {
                imageCopy.remove();
            }
        } catch (error) {
            const message = document.createElement("p");
            message.setAttribute("role", "alert");
            message.className = "rounded-md bg-red-100 p-3 text-red-700";
            message.textContent = error instanceof Error ? error.message : "We could not update your cart. Please try again.";
            form.appendChild(message);
        } finally {
            button.disabled = false;
        }
    });
});

export {};
