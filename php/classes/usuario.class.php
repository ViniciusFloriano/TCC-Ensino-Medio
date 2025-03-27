<?php
        include_once "../../php/utils/autoload.php";
        class Usuario extends Database{
                
            private $id;
            private $nome;
            private $email;
            private $senha;
            private $tipo;
            private $cpf;
            private $telefone;
            private $curriculo;
            private $status;

            public function __construct($id, $nome, $email, $senha, $tipo, $cpf, $telefone, $curriculo, $status) {
                $this->setid($id);
                $this->setnome($nome);
                $this->setemail($email);
                $this->setsenha($senha);
                $this->settipo($tipo);
                $this->setcpf($cpf);
                $this->settelefone($telefone);
                $this->setcurriculo($curriculo);
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
            
            public function getemail() {
                return $this->email;
            }

            public function setemail($email) {
                $this->email = $email;
            }

            public function getsenha() {
                return $this->senha;
            }

            public function setsenha($senha) {
                $this->senha = $senha;
            }

            public function gettipo() {
                return $this->tipo;
            }

            public function settipo($tipo) {
                $this->tipo = $tipo;
            }

            public function getcpf() {
                return $this->cpf;
            }

            public function setcpf($cpf) {
                $this->cpf = $cpf;
            }

            public function gettelefone() {
                return $this->telefone;
            }

            public function settelefone($telefone) {
                $this->telefone = $telefone;
            }

            public function getcurriculo() {
                return $this->curriculo;
            }

            public function setcurriculo($curriculo) {
                $this->curriculo = $curriculo;
            }

            public function getstatus() {
                return $this->status;
            }

            public function setstatus($status) {
                $this->status = $status;
            }

            public function inserir(){
                $sql = 'INSERT INTO tcc.usuario (nome, email, senha, tipo, cpf, telefone, curriculo, status) 
                VALUES (:nome, :email, :senha, :tipo, :cpf, :telefone, :curriculo, :status)';
                $parametros = array(":nome"=>$this->getnome(),
                                    ":email"=>$this->getemail(),
                                    ":senha"=>$this->getsenha(),
                                    ":tipo"=>$this->gettipo(),
                                    ":cpf"=>$this->getcpf(),
                                    ":telefone"=>$this->gettelefone(),
                                    ":curriculo"=>$this->getcurriculo(),
                                    ":status"=>$this->getstatus());
                return parent::executaComando($sql,$parametros);
            }

            public function excluir(){
                $sql = 'UPDATE tcc.usuario SET status = :status
                WHERE id = :id';
                $parametros = array(":status"=>$this->getstatus(),
                                    ":id"=>$this->getid());
                return parent::executaComando($sql,$parametros);
            }

            public function editar(){
                $sql = 'UPDATE tcc.usuario 
                SET nome = :nome, email = :email, senha = :senha, tipo = :tipo, cpf = :cpf, telefone = :telefone, curriculo = :curriculo, status = :status
                WHERE id = :id';
                $parametros = array(":nome"=>$this->getnome(),
                                    ":email"=>$this->getemail(),
                                    ":senha"=>$this->getsenha(),
                                    ":tipo"=>$this->gettipo(),
                                    ":cpf"=>$this->getcpf(),
                                    ":telefone"=>$this->gettelefone(),
                                    ":curriculo"=>$this->getcurriculo(),
                                    ":status"=>$this->getstatus(),
                                    ":id"=>$this->getid());
                return parent::executaComando($sql,$parametros);
            }

            public static function listar($buscar = 0, $procurar = ""){
                $sql = "SELECT * FROM usuario";
                if ($buscar > 0)
                    switch($buscar){
                        case(1): $sql .= " WHERE id like :procurar"; $procurar = "%".$procurar."%"; break;
                        case(2): $sql .= " WHERE nome like :procurar"; $procurar = "%".$procurar."%"; break;
                        case(3): $sql .= " WHERE email like :procurar"; $procurar = "%".$procurar."%"; break;
                        case(4): $sql .= " WHERE senha like :procurar"; $procurar = "%".$procurar."%"; break;
                        case(5): $sql .= " WHERE tipo like :procurar"; $procurar = "%".$procurar."%"; break;
                        case(6): $sql .= " WHERE cpf like :procurar"; $procurar = "%".$procurar."%"; break;
                        case(7): $sql .= " WHERE telefone like :procurar"; $procurar = "%".$procurar."%"; break;
                        case(8): $sql .= " WHERE curriculo like :procurar"; $procurar = "%".$procurar."%"; break;
                        case(9): $sql .= " WHERE status like :procurar"; $procurar = "%".$procurar."%"; break;
                    }
                if ($buscar > 0)
                    $parametros = array(':procurar'=>$procurar);
                else 
                    $parametros = array();
                return parent::buscar($sql, $parametros);
            }

            public static function select($rows="*", $where = null, $search = null, $order = null, $group = null) {
                $pdo = Database::iniciaConexao();
                $sql= "SELECT $rows FROM usuario";
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

            public static function efetuarLogin($email, $senha){
                $sql = "SELECT id, tipo, status FROM usuario WHERE email = :email AND senha = :senha";
                $parametros = array(
                    ':email' => $email,
                    ':senha' => $senha,
                );
                session_set_cookie_params(0);
                session_start();
                if (self::buscar($sql, $parametros) && self::buscar($sql, $parametros)[0]['status'] == "ativado") {
                    $_SESSION['id'] = self::buscar($sql, $parametros)[0]['id'];
                    $_SESSION['tipo'] = self::buscar($sql, $parametros)[0]['tipo'];
                    $_SESSION['status'] = self::buscar($sql, $parametros)[0]['status'];
                    return true;
                } else {
                    $_SESSION['id'] = "";
                    $_SESSION['tipo'] = "";
                    return false;
                }
            }

            public static function consultarData($id){
                $sql = "SELECT * FROM usuario WHERE id = :id";
                $params = array(':id'=>$id);
                return parent::buscar($sql, $params);
            }

            public function ativar(){
                $sql = 'UPDATE tcc.usuario SET status = :status
                WHERE id = :id';
                $parametros = array(":status"=>$this->getstatus(),
                                    ":id"=>$this->getid());
                return parent::executaComando($sql,$parametros);
            }

            public static function listar2($buscar = 0, $procurar = "", $id = ""){
                $sql = "SELECT * FROM usuario WHERE id != $id";
                if ($buscar > 0)
                    switch($buscar){
                        case(1): $sql .= " AND nome like :procurar"; $procurar = "%".$procurar."%"; break;
                    }
                if ($buscar > 0) {
                    $parametros = array(':procurar'=>$procurar);
                    $usu = array(':id'=>$id);
                }else {
                    $parametros = array();
                    $usu = array(':id'=>$id);
                }
                return parent::buscar2($sql, $parametros, $usu);
            }
        }
?>