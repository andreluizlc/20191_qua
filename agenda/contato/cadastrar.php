<?php

  // Não exibe mensagens de alerta
  error_reporting(1);

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

    // Não preencheu algum campo obrigatório?
    if ($nome == "" || $telefone == "" || $cod_grupo == "" ) {

      echo "<script>
              alert('Preencha todos os campos!');
            </script>";

    // Tudo ok.. pode cadastrar no BD
    } else {

      // Cria comando SQL
      $sql = "INSERT INTO contato (nome, telefone, email, cod_grupo, detalhes) 
              VALUES ('$nome', '$telefone', '$email', '$cod_grupo', '$detalhes')";

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

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Agenda</title>
  </head>
  <body>

    <?php include_once "../menu.php"; ?>

    <div class="container">
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

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>