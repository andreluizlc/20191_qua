<?php

  // Não exibe mensagens de alerta
  error_reporting(1);

  // Inicializa a sessão
  session_start();

  // Clicou em enviar?
  if ($_POST != NULL) {

    // Conecta ao BD
    include_once "../conexao_bd.php";

    // Obtém dados do formulário
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $cod_grupo = $_POST["cod_grupo"];
    $detalhes = $_POST["detalhes"];
    $foto = $_POST["foto"];

    // Obtém o ID do usuário logado
    $cod_usuario = $_SESSION["user_id"];

    // Não preencheu algum campo obrigatório?
    if ($nome == "" || $telefone == "" || $cod_grupo == "" ) {

      echo "<script>
              alert('Preencha todos os campos!');
            </script>";

    // Tudo ok.. pode cadastrar no BD
    } else {

      // Cria comando SQL
      $sql = "INSERT INTO contato (nome, telefone, email, cod_grupo, detalhes, foto, cod_usuario) 
              VALUES ('$nome', '$telefone', '$email', '$cod_grupo', '$detalhes', '$foto', '$cod_usuario')";

      // Executa no BD
      $retorno = $conexao->query($sql);

      // Executou no BD?
      if ($retorno == true) {

        echo "<script>
                alert('Cadastrado com Sucesso!');
                location.href='listar.php';
              </script>";

      } else {

        echo "<script>
                alert('Erro ao Cadastrar!');
              </script>";

        echo $conexao->error;

      }

    }

  }

?>

<?php include_once "../topo.php"; ?>

<h1>Cadastrar Contato</h1>

<form method="POST">

  <div class="form-group">
    <label>Nome</label>
    <input type="text" name="nome" maxlength="100" required class="form-control">
  </div>

  <div class="form-group">
    <label>Telefone</label>
    <input type="text" name="telefone" maxlength="50" required class="form-control">
  </div>

  <div class="form-group">
    <label>E-Mail</label>
    <input type="email" name="email" maxlength="100" class="form-control">
  </div>

  <div class="form-group">
    <label>Foto (URL)</label>
    <input type="text" name="foto" class="form-control">
  </div>

  <div class="form-group">
    <label>Grupo</label>
    <select name="cod_grupo" required class="form-control">
      <option value="">Selecione</option>
      <?php

        // Não exibe mensagens de alerta
        error_reporting(1);

        // Conecta ao BD
        include_once "../conexao_bd.php";
        
        // Cria comando SQL
        $sql = "SELECT * 
                FROM grupo";

        // Executa no BD
        $retorno = $conexao->query($sql);

        // Deu erro?
        if ($retorno == false) {
          echo $conexao->error;
        }

        // Percorre todos os registros encontrados
        while( $registro = $retorno->fetch_array() ) {

          // obtém dados do registro
          $id = $registro["id"];
          $nome = $registro["nome"];

          echo "<option value='$id'>$nome</option>";

        }

      ?>
    </select>
  </div>

  <div class="form-group">
    <label>Detalhes</label>
    <textarea name="detalhes" class="form-control"></textarea>
  </div>

  <a href="listar.php" class="btn btn-danger">Cancelar</a>
  <button type="submit" class="btn btn-primary">Salvar</button>
  
</form>

<?php include_once "../rodape.php"; ?>