function confirmarSenha() {
    if (senhaAtual == document.getElementById('senha').value && document.getElementById('novasenha').value == document.getElementById('novasenhaconfirma').value) {
        document.getElementById('enviar').disabled = false;
    } else {
        document.getElementById('enviar').disabled = true;
    }
}