const input_email = document.querySelector<HTMLInputElement>("#eml_email")
const input_password = document.querySelector<HTMLInputElement>("#pwd_password");
const inputs = document.querySelectorAll<HTMLInputElement>("input");


const placeholders = {

    email: [
        "email me, maybe?", "your lovely email... ✧", "drop your email, darling..", "where can we reach you, pretty?","your digital love letter...",   "one email closer to forever ♡", "your inbox called, sweetheart...",
    ],
    contrasena: [
        "your secret password... ✧","your little secret... ♡", "keep it between us...", "shhh... it's a secret!", "a secret just for you...",  "top secret, pretty thing", "locked with love ✧",  "nobody needs to know...",
    ],
    nombre: [
        "what should we call you? ♡","hello, pretty thing...","your name, darling...","who's this sweetheart?"
    ],


};
type placeholderKey = keyof typeof placeholders;
    

inputs.forEach(input => {
    
    const type = input.dataset.placeholder;
    

    console.log(type);

    if(type && type in placeholders){
        const key = type as placeholderKey;
        const options = placeholders[key];
        const selector = Math.floor(Math.random() * options.length)

        console.log(selector);

        const frase = options[selector];

        input.placeholder = frase;
        
    }

});
    