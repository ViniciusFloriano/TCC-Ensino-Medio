<?php 
    session_set_cookie_params(0);
    session_start();
    if(!isset($_SESSION['id']) || $_SESSION['id'] == ''){
        header("Location:login.php");
    }
    include_once ("../../php/utils/autoload.php");
    $data = Usuario::consultarData($_SESSION['id'])[0];
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <?php
            $pdo = Database::iniciaConexao();
            $consulta = $pdo->query("SELECT nome FROM tcc.usuario WHERE ".$_SESSION['id']." = id;");
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
          ?>
          <span class="navbar-brand mb-0" aria-current="page"><?php echo $linha["nome"];?></span>
          <?php } ?>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:white;">
            Projetos
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="cadProjeto.php?analista=<?php echo $_SESSION['id'];?>">Cadastrar Projetos </a></li>
            <li><a class="dropdown-item" href="projetos.php?analista=<?php echo $_SESSION['id'];?>">Ver Projetos </a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="usuarios.php">Usuários</a>
        </li>
      </ul>
    </div>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../../img/user.svg">
          </a>
          <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="perfil.php">Perfil</a></li>
              <li><a class="dropdown-item" href="../../php/controle/controleLogin.php">Encerrar Sessão</a></li>
          </ul>
        </li>
      </ul>
  </div>
</nav>