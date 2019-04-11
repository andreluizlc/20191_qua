<?php

  // Não exibe mensagens de alerta
  error_reporting(1);

  // Clicou em enviar?
  if ($_POST != NULL) {

    // Conecta ao BD
    $conexao = new mysqli("localhost", "root", "", "20191_web");

    // Deu erro na conexão?
    if ($conexao->connect_error) {

      echo "Erro ao conectar: " . $conexao->connect_error . "<br>";

    }

    // Obtém dados do formulário
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $grupo = $_POST["grupo"];
    $detalhes = $_POST["detalhes"];

    // Não preencheu algum campo obrigatório?
    if ($nome == "" || $telefone == "" || $grupo == "" ) {

      echo "<script>
              alert('Preencha todos os campos!');
            </script>";

    // Tudo ok.. pode cadastrar no BD
    } else {

      // Cria comando SQL
      $sql = "INSERT INTO contato (nome, telefone, email, grupo, detalhes) 
              VALUES ('$nome', '$telefone', '$email', '$grupo', '$detalhes')";

      // Executa no BD
      $retono = $conexao->query($sql);

      // Executou no BD?
      if ($retono == true) {

        echo "<script>
                alert('Cadastrado com Sucesso!');
                location.href='cadastrar.php';
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
          <select name="grupo" required class="form-control">
            <option value="">Selecione</option>
            <option value="Amigo">Amigo</option>
            <option value="Família">Família</option>
            <option value="Trabalho">Trabalho</option>
            <option value="Outro">Outro</option>
          </select>
        </div>

        <div class="form-group">
          <label>Detalhes</label>
          <textarea name="detalhes" class="form-control"></textarea>
        </div>

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