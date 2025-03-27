<?php
    function prog($id){
        $conexão = Database::iniciaConexao();
        $consulta = $conexão->query("SELECT usuario.nome FROM usuario_projeto LEFT JOIN usuario ON (usuario_projeto.idusu = usuario.id) AND $id = usuario_projeto.idpro AND usuario.status = 'ativado';");
        foreach ($consulta as $lista){
            $informacao[] = $lista['nome'];
        }
        return $informacao;
    }

    function nome($id){
        $conexão = Database::iniciaConexao();
        $consulta = $conexão->query("SELECT usuario.nome FROM usuario_requisito LEFT JOIN usuario ON (usuario_requisito.idusu = usuario.id) AND $id = usuario_requisito.idreq AND usuario.status = 'ativado';");
        foreach ($consulta as $lista){
            $informacao[] = $lista['nome'];
        }
        return $informacao;
    }

    function nomeP($idpro){
        $conexão = Database::iniciaConexao();
        $vetor = $conexão->query("SELECT nome FROM projeto WHERE projeto.id = $idpro;");
        foreach($vetor as $lista){
            return $lista['nome'];
        }
    }
?>