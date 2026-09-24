const carrito = document.querySelector<HTMLButtonElement>("#carritoICON");
const imagen = document.querySelector<HTMLImageElement>(".img-alt");
const botonProducto = document.querySelectorAll<HTMLButtonElement>(".vynil-item button");

function agregarCarrito(evento: MouseEvent){
    console.log("Click detectado en: ", evento.target);
    const boton = evento.currentTarget as HTMLButtonElement;
    const producto = boton.parentElement;
    
    
}




botonProducto.forEach((boton) => {
    boton.addEventListener("click", agregarCarrito);
});

