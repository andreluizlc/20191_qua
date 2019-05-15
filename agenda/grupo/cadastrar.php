<?php

  // Não exibe mensagens de alerta
  error_reporting(1);

  // Clicou em enviar?
  if ($_POST != NULL) {

    // Conecta ao BD
    include_once "../conexao_bd.php";

    // Obtém dados do formulário
    $nome = $_POST["nome"];

    // Não preencheu algum campo obrigatório?
    if ($nome == "" ) {

      echo "<script>
              alert('Preencha todos os campos!');
            </script>";

    // Tudo ok.. pode cadastrar no BD
    } else {

      // Cria comando SQL
      $sql = "INSERT INTO grupo (nome) 
              VALUES ('$nome')";

      // Executa no BD
      $retorno = $conexao->query($sql);

      // Executou no BD?
      if ($retorno == true) {

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

<?php include_once "../topo.php"; ?>

<h1>Cadastrar Grupo</h1>

<form method="POST">

  <div class="form-group">
    <label>Nome</label>
    <input type="text" name="nome" maxlength="50" required class="form-control">
  </div>

  <button type="submit" class="btn btn-primary">Salvar</button>
  
</form>

<?php include_once "../rodape.php"; ?>