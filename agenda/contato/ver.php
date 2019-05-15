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
    $foto = $registro["foto"];

    // Coloca foto padrão para quem não tem
    if ($foto == "") {
      $foto = "https://img.ibxk.com.br/2017/06/22/22100428046161.jpg";
    }

  } else {

    echo "Este contato não existe!<br>";

  }

?>
<?php include_once "../topo.php"; ?>

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
  <tr>
    <td><b>Foto</b></td>
    <td><img width="150px" src='<?php echo $foto; ?>'></td>
  </tr>
</table>

<?php include_once "../rodape.php"; ?>