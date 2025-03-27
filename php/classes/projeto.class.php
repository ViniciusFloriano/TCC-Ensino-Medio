<?php
        include_once "../../php/utils/autoload.php";
        class Projeto extends Database{
        private $id;
        private $nome;
        private $prazoinicio;
        private $prazofim;
        private $descricao;
        private $edital;
        private $analista;
        private $status;

        public function __construct($id, $nome, $prazoinicio, $prazofim, $descricao, $edital, $analista, $status) {
            $this->setid($id);
            $this->setnome($nome);
            $this->setprazoinicio($prazoinicio);
            $this->setprazofim($prazofim);
            $this->setdescricao($descricao);
            $this->setedital($edital);
            $this->setanalista($analista);
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
        
        public function getprazoinicio() {
            return $this->prazoinicio;
        }

        public function setprazoinicio($prazoinicio) {
            $this->prazoinicio = $prazoinicio;
        }

        public function getprazofim() {
            return $this->prazofim;
        }

        public function setprazofim($prazofim) {
            $this->prazofim = $prazofim;
        }


        public function getdescricao() {
            return $this->descricao;
        }

        public function setdescricao($descricao) {
            $this->descricao = $descricao;
        }

        public function getedital() {
            return $this->edital;
        }

        public function setedital($edital) {
            $this->edital = $edital;
        }

        public function getanalista() {
            return $this->analista;
        }

        public function setanalista($analista) {
            $this->analista = $analista;
        }

        public function getstatus() {
            return $this->status;
        }

        public function setstatus($status) {
            $this->status = $status;
        }

        public function inserir(){
            $sql = 'INSERT INTO tcc.projeto (nome, prazoinicio, prazofim, descricao, edital, analista, status) 
            VALUES (:nome, :prazoinicio, :prazofim, :descricao, :edital, :analista, :status)';
            $parametros = array(":nome"=>$this->getnome(),
                                ":prazoinicio"=>$this->getprazoinicio(),
                                ":prazofim"=>$this->getprazofim(),
                                ":descricao"=>$this->getdescricao(),
                                ":edital"=>$this->getedital(),
                                ":analista"=>$this->getanalista(),
                                ":status"=>$this->getstatus());
            return parent::executaComando($sql,$parametros);
        }

        public function excluir(){
            $sql = 'DELETE FROM tcc.projeto WHERE id = :id';
            $parametros = array(":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }

        public function editar(){
            $sql = 'UPDATE tcc.projeto 
            SET nome = :nome, prazoinicio = :prazoinicio, prazofim = :prazofim, descricao = :descricao, edital = :edital, analista = :analista
            WHERE id = :id';
            $parametros = array(":nome"=>$this->getnome(),
                                ":prazoinicio"=>$this->getprazoinicio(),
                                ":prazofim"=>$this->getprazofim(),
                                ":descricao"=>$this->getdescricao(),
                                ":edital"=>$this->getedital(),
                                ":analista"=>$this->getanalista(),
                                ":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }

        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM projeto";
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " WHERE id like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(2): $sql .= " WHERE nome like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(3): $sql .= " WHERE prazoinicio like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(4): $sql .= " WHERE prazofim like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(5): $sql .= " WHERE descricao like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(6): $sql .= " WHERE edital like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(7): $sql .= " WHERE analista like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(8): $sql .= " WHERE status like :procurar"; $procurar = "%".$procurar."%"; break;
                }
            if ($buscar > 0)
                $parametros = array(':procurar'=>$procurar);
            else 
                $parametros = array(); 
            return parent::buscar($sql, $parametros);
        }

        public static function select($rows="*", $where = null, $search = null, $order = null, $group = null) {
            $pdo = Database::iniciaConexao();
            $sql= "SELECT $rows FROM projeto";
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

        public static function consultarData($id){
            $sql = "SELECT * FROM projeto WHERE id = :id";
            $params = array(':id'=>$id);
            return parent::buscar($sql, $params);
        }

        public static function listar2($buscar = 0, $procurar = "", $analista = 0){
            $sql = "SELECT * FROM projeto WHERE analista = $analista";
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " AND nome like :procurar"; $procurar = "%".$procurar."%"; break;
                }
            if ($buscar > 0){
                $parametros = array(':procurar'=>$procurar);
                $usu = array(':analista'=>$analista);
            } else {
                $parametros = array();
                $usu = array(':analista'=>$analista);
            }
            return parent::buscar2($sql, $parametros, $usu);
        }

        public function status(){
            $sql = 'UPDATE tcc.projeto SET status = :status
            WHERE id = :id';
            $parametros = array(":status"=>$this->getstatus(),
                                ":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }
    }
?>