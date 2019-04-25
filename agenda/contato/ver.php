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
    $detalhes = $registro["detalhes"];

  } else {

    echo "Este contato não existe!<br>";

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

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <title>Agenda</title>
  </head>
  <body>

    <?php include_once "../menu.php"; ?>

    <div class="container">
      <h1>Ver Contato</h1>

      <a class="btn btn-primary" href="listar.php">Voltar</a>
      <br><br>

      <table class="table table-bordered table-striped">
        <tr>
          <td><b>ID</b></td>
          <td><?php echo $id; ?></td>
        </tr>
        <tr>
          <td><b>Nome</b></td>
          <td><?php echo $nome; ?></td>
        </tr>
        <tr>
          <td><b>Telefone</b></td>
          <td><?php echo $telefone; ?></td>
        </tr>
        <tr>
          <td><b>E-Mail</b></td>
          <td><?php echo $email; ?></td>
        </tr>
        <tr>
          <td><b>Grupo</b></td>
          <td><?php echo $grupo_nome; ?></td>
        </tr>
        <tr>
          <td><b>Detalhes</b></td>
          <td><?php echo $detalhes; ?></td>
        </tr>
      </table>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>