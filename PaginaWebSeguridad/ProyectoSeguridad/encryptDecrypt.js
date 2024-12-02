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
