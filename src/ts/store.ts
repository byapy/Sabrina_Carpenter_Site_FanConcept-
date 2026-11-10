import type { gsap as Gsap } from "gsap";
import type { Flip as FlipPlugin } from "gsap/Flip";

declare global {
    interface Window {
        gsap: typeof Gsap;
        Flip: typeof FlipPlugin;
    }
}

const carrito = document.querySelector<HTMLAnchorElement>("#carritoICON");
const imagen = document.querySelector<HTMLImageElement>(".img-alt");
const botonProducto = document.querySelectorAll<HTMLButtonElement>(".shop-item button");
// Ambas páginas cargan los archivos UMD locales antes de este módulo.
const { gsap, Flip } = window;

gsap.registerPlugin(Flip);

/* Lo de añadir productos al carrito */ 
function agregarCarrito(evento: MouseEvent){
    const boton = evento.currentTarget as HTMLButtonElement;
    const producto = boton.parentElement;

    if(producto != null ){
        const item = producto.parentElement;
        if(item){
            //console.log(item);
            const imagen = item.querySelector<HTMLImageElement>(".img-normal");
            if (imagen && carrito){
                const posicion = imagen.getBoundingClientRect();
                const copia = imagen.cloneNode(true) as HTMLImageElement
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

//Pagina del carrito

const carritoCompras = document.querySelector<HTMLDivElement>("#carrito-mostrar");
const carritoArticulos = document.querySelectorAll<HTMLElement>(".carrito-articulo");



console.log(carritoCompras);
console.log(carritoArticulos);

let totalCarrito = 0;
//Recorremos cada uno de los articulos para sacar sus datos.
carritoArticulos.forEach(articulo => {

    const precio = articulo.querySelector(".producto-price");
    const cantidad = articulo.querySelector(".quantity-value")

    
    const cantidadVerdadera = Number(cantidad?.textContent)
    const precioNumerico = Number(precio?.textContent?.replace("$",""));


    console.log("El precio es de", precioNumerico, "dolares", "y son", cantidadVerdadera, "Articulos");
    
//Cuando el usuario llegue a 0, el producto se va quitar de su carrito


const subtotal = precioNumerico * cantidadVerdadera;
totalCarrito += subtotal;

});


console.log("El total es de: ", totalCarrito);

const botonIncrementar =  document.querySelectorAll<HTMLButtonElement>('[data-action="increase"]');
const botonDecrementar = document.querySelectorAll<HTMLButtonElement>('[data-action="decrease"]');
const botonEliminar =  document.querySelectorAll<HTMLButtonElement>('[data-action="delete"]');
botonIncrementar.forEach(boton => {
    
    boton.addEventListener('click' , (event) =>{
        console.log("Boton incrementar presionado");
        const articulo =  (event.currentTarget as  HTMLElement)
            .closest('.carrito-articulo')
        console.log(event.currentTarget);
        const cantidad = articulo?.querySelector('.quantity-value')
        let cantidadActual = Number(cantidad?.textContent)
        console.log(cantidadActual);
        cantidadActual += 1;
        if(cantidad){
                 cantidad.textContent = String(cantidadActual);
        }    
    })

    
});


function eliminarArticulo(articulo: Element | null) {
    if (!articulo) return;

    const estado = Flip.getState('.carrito-articulo');

    gsap.to(articulo, {
        x: 40,
        opacity: 0,
        duration: 1,
        ease: "power1.out",

        onComplete: () => {
            articulo.remove();

            Flip.from(estado, {
                duration: 0.5,
                ease: "circ.out"
            });
        }
    });
}



botonDecrementar.forEach(boton => {
    boton.addEventListener('click', (event) => {
        console.log("Boton decrementar presionado");

        const articulo = (event.currentTarget as HTMLElement)
            .closest('.carrito-articulo');

        console.log(event.currentTarget);

        const cantidad = articulo?.querySelector('.quantity-value');
        let cantidadActual = Number(cantidad?.textContent);

        if (cantidad && Number.isInteger(cantidadActual) && cantidadActual > 0) {
            cantidadActual -= 1;

            if (cantidadActual === 0) {
                const confirmar = window.confirm(
                    "This item will be removed from your cart. Continue?"
                );

                if (confirmar) {
                    eliminarArticulo(articulo);
                }
            } else {
                cantidad.textContent = String(cantidadActual);
            }
        }
    });
});



botonEliminar.forEach(boton => {
    boton.addEventListener('click', (event) => {
        const articulo = (event.currentTarget as HTMLElement)
            .closest('.carrito-articulo');

        const confirmar = window.confirm("Remove this item?");

        if (confirmar) {
            eliminarArticulo(articulo);
        }

        console.log(confirmar);
    });
});





