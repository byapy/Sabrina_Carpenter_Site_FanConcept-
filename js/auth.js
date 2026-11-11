"use strict";
const inputs = document.querySelectorAll("input");
const botonRegistro = document.querySelector("#btn-register");
const botonLogin = document.querySelector("#btn-login");
const login = document.querySelector("#login-box");
const register = document.querySelector("#register-box");
const placeholders = {
    email: [
        "email me, maybe?", "your lovely email... ✧", "drop your email, darling..", "where can we reach you, pretty?", "your digital love letter...", "one email closer to forever ♡", "your inbox called, sweetheart...",
    ],
    contrasena: [
        "your secret password... ✧", "your little secret... ♡", "keep it between us...", "shhh... it's a secret!", "a secret just for you...", "top secret, pretty thing", "locked with love ✧", "nobody needs to know...",
    ],
    nombre: [
        "what should we call you? ♡", "hello, pretty thing...", "your name, darling...", "who's this sweetheart?", "A name as sweet as you?", "Who am I falling for?"
    ],
    apellido: [
        "Complete your pretty little name.", "What's your second name?", "Your last name, sweetheart...", "Your surname goes here, honey."
    ],
    direccion: [
        "Where should we send the love?", "Your little corner of the world...", "1. Where can we find you, angel?"
    ],
    telefono: [
        "Your phone number...", "Where can we reach you?", "Your number, darling..."
    ],
};
inputs.forEach(input => {
    const type = input.dataset.placeholder;
    console.log(type);
    if (type && type in placeholders) {
        const key = type;
        const options = placeholders[key];
        const selector = Math.floor(Math.random() * options.length);
        console.log(selector);
        const frase = options[selector];
        input.placeholder = frase;
    }
});
botonRegistro?.addEventListener('click', () => {
    login?.classList.add('hidden');
    register?.classList.remove('hidden');
    botonRegistro.classList.add('hidden');
    botonLogin?.classList.toggle('hidden', false);
    sessionStorage.setItem('formularioActivo', 'register');
    console.log("Menu de Registro");
});
botonLogin?.addEventListener('click', () => {
    login?.classList.remove('hidden');
    register?.classList.add('hidden');
    botonLogin.classList.add('hidden');
    botonRegistro?.classList.remove('hidden');
    sessionStorage.setItem('formularioActivo', 'login');
    console.log("Menu de Login");
});
const formularioActivo = sessionStorage.getItem('formularioActivo');
if (formularioActivo === 'register') {
    login?.classList.add('hidden');
    register?.classList.remove('hidden');
    botonRegistro?.classList.add('hidden');
    botonLogin?.classList.remove('hidden');
}
//# sourceMappingURL=auth.js.map