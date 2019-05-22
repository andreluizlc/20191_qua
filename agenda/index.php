<?php

  // Não exibe mensagens de alerta
  error_reporting(1);

  // Clicou em enviar?
  if ($_POST != NULL) {

    // Conecta ao BD
    include_once "conexao_bd.php";

    // Obtém dados do formulário
    $login = addslashes($_POST["login"]);
    $senha = addslashes($_POST["senha"]);

    // criptografa a senha digitada pelo usuário
    $senha = md5($senha);

    // Cria comando SQL
    $sql = "SELECT * 
    		FROM usuario 
    		WHERE login = '$login' 
    		AND senha = '$senha'";

    // Executa SQL no BD
    $retorno = $conexao->query($sql);

    // Deu erro?
    if ( $retorno == false ) {
    	echo $conexao->error;
    	exit;
    }

    // Encontrou usuário?
    if ($registro = $retorno->fetch_array()) {

    	$id = $registro["id"];
    	$nome = $registro["nome"];

    	// Inicializa a sessão
    	session_start();

    	// Guarda os dados na sessão
    	$_SESSION["logado"] = "ok";
    	$_SESSION["user_id"] = $id;
    	$_SESSION["user_name"] = $nome;

    	// Redireciona
    	header("Location: contato/listar.php");

    } else {

        echo "<script>
                alert('Usuário ou Senha Inválida!');
              </script>";

    }

  }

?>
<?php include_once "topo_login.php"; ?>

	<h1>Acesso Restrito</h1>

	<form method="POST">
		
		<div class="form-group">
			<label>Login</label>
			<input type="text" name="login" required class="form-control">
		</div>

		<div class="form-group">
			<label>Senha</label>
			<input type="password" name="senha" required class="form-control">
		</div>

		<button type="submit" class="btn btn-primary">Entrar</button>

	</form>

<?php include_once "rodape.php"; ?>