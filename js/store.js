"use strict";
const carrito = document.querySelector("#carritoICON");
const imagen = document.querySelector(".img-alt");
const botonProducto = document.querySelectorAll(".shop-item button");
function agregarCarrito(evento) {
    const boton = evento.currentTarget;
    const producto = boton.parentElement;
    if (producto != null) {
        const item = producto.parentElement;
        if (item) {
            //console.log(item);
            const imagen = item.querySelector(".img-normal");
            if (imagen && carrito) {
                const posicion = imagen.getBoundingClientRect();
                const copia = imagen.cloneNode(true);
                const carritoPosicion = carrito.getBoundingClientRect();
                document.body.appendChild(copia);
                copia.style.position = "fixed";
                copia.style.left = `${posicion.left}px`;
                copia.style.top = `${posicion.top}px`;
                copia.style.width = `${posicion.width}px`;
                copia.style.transition = 'all 1.5s ease';
                boton.disabled = true;
                requestAnimationFrame(() => {
                    console.log("Moviendo hacia:", carritoPosicion.left, carritoPosicion.top);
                    copia.style.left = `${carritoPosicion.left + carritoPosicion.width / 2 - posicion.width / 2}px`;
                    copia.style.top = `${carritoPosicion.top + carritoPosicion.height / 2 - posicion.height / 2}px`;
                    copia.style.transform = "scale(0.2)";
                    copia.addEventListener("transitionend", () => {
                        copia.remove();
                        boton.disabled = false;
                    });
                });
            }
        }
    }
}
botonProducto.forEach((boton) => {
    boton.addEventListener("click", agregarCarrito);
});
//# sourceMappingURL=store.js.map