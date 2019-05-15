<?php include_once "../topo.php"; ?>

<h1>Contatos</h1>

<table class="table table-bordered table-striped">
  <tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Telefone</th>
    <th>Ver</th>
    <th>Editar</th>
    <th>Apagar</th>
  </tr>
  <?php

    // Não exibe mensagens de alerta
    error_reporting(1);

    // Conecta ao BD
    include_once "../conexao_bd.php";

    // Cria comando SQL
    $sql = "SELECT * 
            FROM contato";

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
      $telefone = $registro["telefone"];

      echo "<tr>
              <td>$id</td>
              <td>$nome</td>
              <td>$telefone</td>
              <td><a title='Ver Dados do Contato' class='btn btn-info' href='ver.php?id=$id'><i class='far fa-eye'></i></a></td>
              <td><a title='Editar Contato' class='btn btn-warning' href='editar.php?id=$id'><i class='far fa-edit'></i></a></td>
              <td><a onclick=\"return confirm('Deseja apagar?');\" title='Apagar Contato' class='btn btn-danger' href='apagar.php?id=$id'><i class='fas fa-trash-alt'></i></a></td>
            </tr>";

    }

  ?>
  
</table>

<?php include_once "../rodape.php"; ?>