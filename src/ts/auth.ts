const input_email = document.querySelector<HTMLInputElement>("#eml_email")
const input_password = document.querySelector<HTMLInputElement>("#pwd_password");
const inputs = document.querySelectorAll<HTMLInputElement>("input");


const placeholders = {

    email: [
        "your secret password... ✧", "email me, maybe?", "your lovely email... ✧", "drop your email, darling..", "where can we reach you, pretty?"
    ],
    contrasena: [
        "your little secret... ♡", "keep it between us...", "- shhh... it's a secret!", "a secret just for you..."  
    ],
    nombre: [
        "what should we call you? ♡","hello, pretty thing...","your name, darling...","who's this sweetheart?"
    ],


};
    
    
    
console.log(placeholders.nombre);
inputs.forEach(input => {
    console.log(input);
});
    