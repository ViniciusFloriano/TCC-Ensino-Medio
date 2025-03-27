<?php
        include_once "../../php/utils/autoload.php";
        class Usuario_Projeto extends Database{

        private $idusu;
        private $idpro;

        public function __construct($idusu, $idpro) {
            $this->setidusu($idusu);
            $this->setidpro($idpro);
        }

        public function getidusu() {
            return $this->idusu;
        }

        public function setidusu($idusu) {
            $this->idusu = $idusu;
        }     

        public function getidpro() {
            return $this->idpro;
        }

        public function setidpro($idpro) {
            $this->idpro = $idpro;
        }

        public function inserir(){
            $sql = 'INSERT INTO tcc.usuario_projeto (idusu, idpro) 
            VALUES (:idusu, LAST_INSERT_ID())';
            $parametros = array(":idusu"=>$this->getidusu());
            return parent::executaComando($sql,$parametros);
        }

        public function excluir(){
            $sql = 'DELETE FROM tcc.usuario_projeto WHERE idpro = :idpro;';
            $parametros = array(":idpro"=>$this->getidpro());
            return parent::executaComando($sql,$parametros);
        }

        public function inserir2(){
            $sql = 'INSERT INTO tcc.usuario_projeto (idusu, idpro) 
            VALUES (:idusu, :idpro);';
            $parametros = array(":idusu"=>$this->getidusu(),
                                ":idpro"=>$this->getidpro());
            return parent::executaComando($sql,$parametros);
        }

        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM usuario_projeto";
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " WHERE idusu like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(2): $sql .= " WHERE idpro like :procurar"; $procurar = "%".$procurar."%"; break;
                }
            if ($buscar > 0)
                $parametros = array(':procurar'=>$procurar);
            else 
                $parametros = array();
            return parent::buscar($sql, $parametros);
        }

        public static function select($rows="*", $where = null, $search = null, $order = null, $group = null) {
            $pdo = Database::iniciaConexao();
            $sql= "SELECT $rows FROM usuario_projeto";
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