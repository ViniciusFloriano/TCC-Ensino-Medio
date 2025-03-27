<?php
        include_once "../../php/utils/autoload.php";
        class Requisito extends Database{
        private $id;
        private $nome;
        private $prazo;
        private $descricao;
        private $idpro;
        private $status;

        public function __construct($id, $nome, $prazo, $descricao, $idpro, $status) {
            $this->setid($id);
            $this->setnome($nome);
            $this->setprazo($prazo);
            $this->setdescricao($descricao);
            $this->setidpro($idpro);
            $this->setstatus($status);
        }

        public function getid() {
            return $this->id;
        }

        public function setid($id) {
            $this->id = $id;
        }     

        public function getnome() {
            return $this->nome;
        }

        public function setnome($nome) {
            $this->nome = $nome;
        }
        
        public function getprazo() {
            return $this->prazo;
        }

        public function setprazo($prazo) {
            $this->prazo = $prazo;
        }

        public function getdescricao() {
            return $this->descricao;
        }

        public function setdescricao($descricao) {
            $this->descricao = $descricao;
        }
        
        public function getidpro() {
            return $this->idpro;
        }

        public function setidpro($idpro) {
            $this->idpro = $idpro;
        }

        public function getstatus() {
            return $this->status;
        }

        public function setstatus($status) {
            $this->status = $status;
        }

        public function inserir(){
            $sql = 'INSERT INTO tcc.requisito (nome, prazo, descricao, idpro, status) 
            VALUES (:nome, :prazo, :descricao, :idpro, :status)';
            $parametros = array(":nome"=>$this->getnome(),
                                ":prazo"=>$this->getprazo(),
                                ":descricao"=>$this->getdescricao(),
                                ":idpro"=>$this->getidpro(),
                                ":status"=>$this->getstatus());
            return parent::executaComando($sql,$parametros);
        }

        public function excluir(){
            $sql = 'DELETE FROM tcc.requisito WHERE id = :id';
            $parametros = array(":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }

        public function editar(){
            $sql = 'UPDATE tcc.requisito 
            SET nome = :nome, prazo = :prazo, descricao = :descricao, idpro = :idpro
            WHERE id = :id';
            $parametros = array(":nome"=>$this->getnome(),
                                ":prazo"=>$this->getprazo(),
                                ":descricao"=>$this->getdescricao(),
                                ":idpro"=>$this->getidpro(),
                                ":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }

        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM requisito";
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " WHERE id like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(2): $sql .= " WHERE nome like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(3): $sql .= " WHERE prazo like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(4): $sql .= " WHERE descricao like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(5): $sql .= " WHERE idpro like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(6): $sql .= " WHERE status like :procurar"; $procurar = "%".$procurar."%"; break;
                }
            if ($buscar > 0)
                $parametros = array(':procurar'=>$procurar);
            else 
                $parametros = array();
            return parent::buscar($sql, $parametros);
        }

        public static function select($rows="*", $where = null, $search = null, $order = null, $group = null) {
            $pdo = Database::iniciaConexao();
            $sql= "SELECT $rows FROM requisito";
            if($where != null) {
                $sql .= " WHERE $where";
                if($search != null) {
                    if(is_numeric($search) == false) {
                        $sql .= " LIKE '%". trim($search) ."%'";
                    } else if(is_numeric($search) == true) {
                        $sql .= " <= '". trim($search) ."'";
                    }
                }
            }
            if($order != null) {
                $sql .= " ORDER BY $order";
            }
            if($group != null) {
                $sql .= " GROUP BY $group";
            }
            $sql .= ";";
            return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function consultarData($idpro){ 
            $sql = "SELECT * FROM requisito WHERE idpro = :idpro";
            $params = array(':idpro'=>$idpro);
            return parent::buscar($sql, $params);
        }

        public static function listar2($buscar = 0, $procurar = "", $idpro = ""){
            $sql = "SELECT * FROM requisito WHERE idpro = $idpro";
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " AND nome like :procurar"; $procurar = "%".$procurar."%"; break;
                }
            if ($buscar > 0){
                $parametros = array(':procurar'=>$procurar);
                $usu = array(':idpro'=>$idpro);
            } else {
                $parametros = array();
                $usu = array(':idpro'=>$idpro);
            }
            return parent::buscar2($sql, $parametros, $usu);
        }

        public function status(){
            $sql = 'UPDATE tcc.requisito SET status = :status
            WHERE id = :id';
            $parametros = array(":status"=>$this->getstatus(),
                                ":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }
    }
?>