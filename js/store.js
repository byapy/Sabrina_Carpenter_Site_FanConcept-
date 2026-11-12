const cartLink = document.querySelector("#carritoICON");
const addToCartButtons = document.querySelectorAll(".shop-item [name='add_to_cart']");
addToCartButtons.forEach((button) => {
    const form = button.closest("form");
    if (!form)
        return;
    form.addEventListener("submit", async (event) => {
        event.preventDefault();
        if (button.disabled)
            return;
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
            const product = button.closest(".shop-item");
            const image = product?.querySelector(".img-normal");
            if (!image || !cartLink) {
                return;
            }
            const imagePosition = image.getBoundingClientRect();
            const cartPosition = cartLink.getBoundingClientRect();
            const imageCopy = image.cloneNode(true);
            imageCopy.style.position = "fixed";
            imageCopy.style.left = `${imagePosition.left}px`;
            imageCopy.style.top = `${imagePosition.top}px`;
            imageCopy.style.width = `${imagePosition.width}px`;
            imageCopy.style.zIndex = "1000";
            imageCopy.style.pointerEvents = "none";
            imageCopy.style.transition = "all 700ms ease";
            document.body.appendChild(imageCopy);
            button.disabled = true;
            requestAnimationFrame(() => {
                imageCopy.style.left = `${cartPosition.left + cartPosition.width / 2 - imagePosition.width / 2}px`;
                imageCopy.style.top = `${cartPosition.top + cartPosition.height / 2 - imagePosition.height / 2}px`;
                imageCopy.style.transform = "scale(0.2)";
                imageCopy.style.opacity = "0.5";
            });
            await new Promise((resolve) => window.setTimeout(() => {
                imageCopy.remove();
                resolve();
            }, 750));
        }
        catch (error) {
            const message = document.createElement("p");
            message.setAttribute("role", "alert");
            message.className = "rounded-md bg-red-100 p-3 text-red-700";
            message.textContent = error instanceof Error ? error.message : "We could not update your cart. Please try again.";
            form.appendChild(message);
        }
        finally {
            button.disabled = false;
        }
    });
});
export {};
//# sourceMappingURL=store.js.map