const cartLink = document.querySelector<HTMLAnchorElement>("#carritoICON");
const addToCartButtons = document.querySelectorAll<HTMLButtonElement>(".shop-item [name='add_to_cart']");

addToCartButtons.forEach((button) => {
    button.addEventListener("click", (event) => {
        const form = button.closest<HTMLFormElement>("form");
        const product = button.closest<HTMLElement>(".shop-item");
        const image = product?.querySelector<HTMLImageElement>(".img-normal");

        if (!form || !image || !cartLink) {
            return;
        }

        event.preventDefault();

        const imagePosition = image.getBoundingClientRect();
        const cartPosition = cartLink.getBoundingClientRect();
        const imageCopy = image.cloneNode(true) as HTMLImageElement;

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

        window.setTimeout(() => {
            imageCopy.remove();
            button.disabled = false;
            form.requestSubmit(button);
        }, 750);
    });
});

export {};
