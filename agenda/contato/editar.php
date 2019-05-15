<?php

  // Não exibe mensagens de alerta
  error_reporting(1);


  // Conecta ao BD
  include_once "../conexao_bd.php";

  // Obtém o ID via GET
  $id = $_GET["id"];

  // Passou o ID?
  if ($id == NULL) {
    echo "O ID não foi passado! <br><br>";
  }

  // Cria comando SQL 
  $sql = "SELECT contato.*, grupo.nome AS grupo_nome
          FROM contato 
          INNER JOIN grupo 
          ON contato.cod_grupo = grupo.id 
          WHERE contato.id = $id";

  // Executa no BD
  $retorno = $conexao->query($sql);

  // Deu erro?
  if ($retorno == false) {
    echo $conexao->error;
    exit;
  }

  // Encontrou o contato?
  if ( $registro = $retorno->fetch_array() ) {

    // obtém dados do registro
    $id = $registro["id"];
    $nome = $registro["nome"];
    $telefone = $registro["telefone"];
    $email = $registro["email"];
    $grupo_nome = $registro["grupo_nome"];
    $cod_grupo = $registro["cod_grupo"];
    $detalhes = $registro["detalhes"];
    $foto = $registro["foto"];

  } else {

    echo "Este contato não existe!<br>";

  }


  // ====================================================


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

    // Não preencheu algum campo obrigatório?
    if ($nome == "" || $telefone == "" || $cod_grupo == "" ) {

      echo "<script>
              alert('Preencha todos os campos!');
            </script>";

    // Tudo ok.. pode cadastrar no BD
    } else {

      // Cria comando SQL
      $sql = "UPDATE contato 
              SET nome = '$nome',
                  telefone = '$telefone',
                  email = '$email',
                  foto = '$foto',
                  cod_grupo = '$cod_grupo',
                  detalhes = '$detalhes'
              WHERE id = '$id'";

      // Executa no BD
      $retorno = $conexao->query($sql);

      // Executou no BD?
      if ($retorno == true) {

        echo "<script>
                alert('Atuaizado com Sucesso!');
                location.href='listar.php';
              </script>";

      } else {

        echo "<script>
                alert('Erro ao Atualizar!');
              </script>";

        echo $conexao->error;

      }

    }

  }

?>

<?php include_once "../topo.php"; ?>

<h1>Editar Contato</h1>

<form method="POST">

  <div class="form-group">
    <label>Nome</label>
    <input type="text" name="nome" maxlength="100" required class="form-control" value="<?php echo $nome; ?>">
  </div>

  <div class="form-group">
    <label>Telefone</label>
    <input type="text" name="telefone" maxlength="50" required class="form-control" value="<?php echo $telefone; ?>">
  </div>

  <div class="form-group">
    <label>E-Mail</label>
    <input type="email" name="email" maxlength="100" class="form-control" value="<?php echo $email; ?>">
  </div>

  <div class="form-group">
    <label>Foto (URL)</label>
    <input type="text" name="foto" class="form-control" value="<?php echo $foto; ?>">
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

          // Seleciona o grupo do contato
          if ($cod_grupo == $id) {
            echo "<option selected value='$id'>$nome</option>";
          } else {
            echo "<option value='$id'>$nome</option>";
          }

        }

      ?>
    </select>
  </div>

  <div class="form-group">
    <label>Detalhes</label>
    <textarea name="detalhes" class="form-control"><?php echo $detalhes; ?></textarea>
  </div>

  <a href="listar.php" class="btn btn-danger">Cancelar</a>
  <button type="submit" class="btn btn-primary">Salvar</button>
  
</form>

<?php include_once "../rodape.php"; ?>