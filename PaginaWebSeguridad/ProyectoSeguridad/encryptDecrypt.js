function isValidInput(input) {
    const regex = /^[a-zA-Z0-9]+$/; // Solo permite letras y números return regex.test(input);
    return regex.test(input); 
   }


function encryptText() {
    const plaintext = document.getElementById('plaintext').value;
    const key = 'mysecretkey12345'; // Clave de encriptaci�n (debe tener 16 caracteres para AES-128)
    const encrypted = CryptoJS.AES.encrypt(plaintext, key).toString();
    const encryptedLabel = document.getElementById('encryptedLabel');
    encryptedLabel.innerText = `Texto Encriptado: ${encrypted}`;
    return false; // Evita el env�o del formulario
}


function decryptText() {
    const ciphertext = document.getElementById('ciphertext').value;
    const key = 'mysecretkey12345'; // Clave de desencriptaci�n
    const decrypted = CryptoJS.AES.decrypt(ciphertext, key).toString(CryptoJS.enc.Utf8);
    const decryptedLabel = document.getElementById('decryptedLabel');
    decryptedLabel.innerText = `Texto Desencriptado: ${decrypted}`;
    return false; // Evita el env�o del formulario
}

function validateForm(form) {
    const username = form.username.value; 
    const password = form.password.value; 
    if (!isValidInput(username) || !isValidInput(password)) { 
       alert('El nombre de usuario o la contraseña contienen caracteres no permitidos.'); 
       return false; 
   } 
   return true;
}