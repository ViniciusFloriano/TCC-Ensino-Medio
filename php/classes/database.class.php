<?php 
  class Database{
    public static function iniciaConexao(){
      require_once "../../conf/Conexao.php";
      require_once "../../conf/conf.inc.php";
      return Conexao::getInstance();
    }

    public static function vinculaParametros($stmt, $parametros=array()){
        foreach ($parametros as $chave=>$valor){
          $stmt->bindValue($chave, $valor);
        }
        return $stmt;
    }

    public static function executaComando($sql, $parametros=array()){
        $conexao = self::iniciaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt = self::vinculaParametros($stmt, $parametros);
        try{
          return $stmt->execute();
        } catch(Exception $e) {
          echo "<h1>Erro:".$e->getMessage();
        }
    }

    public static function buscar($sql, $parametros=array()){
      $conexao = self::iniciaConexao();
      $stmt = $conexao->prepare($sql);
      $stmt = self::vinculaParametros($stmt, $parametros);
      $stmt->execute();
      return $stmt->fetchALL();
    }

    public static function buscar2($sql, $parametros=array(), $usu=array()){
      $conexao = self::iniciaConexao();
      $stmt = $conexao->prepare($sql);
      $stmt = self::vinculaParametros($stmt, $parametros, $usu);
      $stmt->execute();
      return $stmt->fetchALL();
    }

    public static function arquivo($sql){
      $conexao = self::iniciaConexao();
      $stmt = $conexao->prepare($sql);
      $stmt = self::vinculaParametros($stmt);
      $stmt->execute();
      return $stmt->fetchALL();
    }
  }
?>