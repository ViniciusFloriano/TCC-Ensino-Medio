<?php
        include_once "../../php/utils/autoload.php";
        class Usuario_Requisito extends Database{

        private $idusu;
        private $idreq;

        public function __construct($idusu, $idreq) {
            $this->setidusu($idusu);
            $this->setidreq($idreq);
        }

        public function getidusu() {
            return $this->idusu;
        }

        public function setidusu($idusu) {
            $this->idusu = $idusu;
        }     

        public function getidreq() {
            return $this->idreq;
        }

        public function setidreq($idreq) {
            $this->idreq = $idreq;
        }

        public function inserir(){
            $sql = 'INSERT INTO tcc.usuario_requisito (idusu, idreq) 
            VALUES (:idusu, LAST_INSERT_ID())';
            $parametros = array(":idusu"=>$this->getidusu());
            return parent::executaComando($sql,$parametros);
        }

        public function excluir(){
            $sql = 'DELETE FROM tcc.usuario_requisito WHERE idreq = :idreq;';
            $parametros = array(":idreq"=>$this->getidreq());
            return parent::executaComando($sql,$parametros);
        }

        public function inserir2(){
            $sql = 'INSERT INTO tcc.usuario_requisito (idusu, idreq) 
            VALUES (:idusu, :idreq);';
            $parametros = array(":idusu"=>$this->getidusu(),
                                ":idreq"=>$this->getidreq());
            return parent::executaComando($sql,$parametros);
        }

        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM usuario_requisito";
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " WHERE idusu like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(2): $sql .= " WHERE idreq like :procurar"; $procurar = "%".$procurar."%"; break;
                }
            if ($buscar > 0)
                $parametros = array(':procurar'=>$procurar);
            else 
                $parametros = array();
            return parent::buscar($sql, $parametros);
        }

        public static function select($rows="*", $where = null, $search = null, $order = null, $group = null) {
            $pdo = Database::iniciaConexao();
            $sql= "SELECT $rows FROM usuario_requisito";
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
    }
?>