<?php
    $campo = $_GET["campo"];
    $valor = $_GET["valor"];

    if ($campo == "nome") {
        if ($valor == "") {
            echo "Preencha o campo com seu Nome";
        }
    } else if ($campo == "email") {
        if ($valor == "") {
            echo "Preencha o campo com seu Email";
        } 
    } else if ($campo == "email2") {
        if ($valor == "") {
            echo "Preencha o campo com seu Email";
        } 
    } else if ($campo == "senha") {
        if ($valor == "") {
            echo "Preencha o campo com seu Senha";
        } elseif (strlen($valor) < 4) {
            echo "O Senha deve ter no minimo 6 caracteres";
        }
    } else if ($campo == "senha2") {
        if ($valor == "") {
            echo "Preencha o campo com seu Senha";
        } elseif (strlen($valor) < 4) {
            echo "O Senha deve ter no minimo 6 caracteres";
        }
    } else if ($campo == "cpf") {
        if ($valor == "") {
            echo "Preencha o campo com seu CPF";
        } elseif (strlen($valor) < 4) { 
            echo "O CPF deve ter no minimo 11 numeros";
        }
    } else if ($campo == "telefone") {
        if ($valor == "") {
            echo "Preencha o campo com seu Telefone";
        } elseif (strlen($valor) < 15) {
            echo "O Telefone deve ter no minimo 11 numeros";
        }
    }

    header("Content-Type: text/html; charset=ISO-8859-1",true);
?>