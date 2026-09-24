"use strict";
const carrito = document.querySelector("#carritoICON");
const imagen = document.querySelector(".img-alt");
const botonProducto = document.querySelectorAll(".vynil-item button");
function agregarCarrito(evento) {
    console.log("Click detectado en: ", evento.target);
    const boton = evento.currentTarget;
    const producto = boton.parentElement;
}
botonProducto.forEach((boton) => {
    boton.addEventListener("click", agregarCarrito);
});
//# sourceMappingURL=store.js.map