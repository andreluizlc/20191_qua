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
      <h1>Contatos</h1>

      <table class="table table-bordered table-striped">
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Telefone</th>
        </tr>
        <?php

          // Não exibe mensagens de alerta
          error_reporting(1);

          // Conecta ao BD
          $conexao = new mysqli("localhost", "root", "", "20191_web");

          // Deu erro na conexão?
          if ($conexao->connect_error) {

            echo "Erro ao conectar: " . $conexao->connect_error . "<br>";

          }

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
                  </tr>";

          }

        ?>
        
      </table>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>