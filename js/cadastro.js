function confirmacao() {
    if (document.getElementById('senha').value == document.getElementById('senha2').value && document.getElementById('senha').value.length >= 6 && document.getElementById('email').value == document.getElementById('email2').value) {
        document.getElementById('enviar').disabled = false;
    } else {
        document.getElementById('enviar').disabled = true;
    }
}