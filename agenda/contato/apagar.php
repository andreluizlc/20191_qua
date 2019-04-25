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
  $sql = "DELETE FROM contato
          WHERE id = $id";

  // Executa no BD
  $retorno = $conexao->query($sql);

  // Executou no BD?
  if ($retorno == true) {

    echo "<script>
            alert('Deletado com Sucesso!');
            location.href='listar.php';
          </script>";

  } else {

    echo "<script>
            alert('Erro ao Deletar!');
          </script>";

    echo $conexao->error;

  }

?>