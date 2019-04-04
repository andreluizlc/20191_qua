<html>
	<head>
		<title>Aula 6 - Introdução PHP</title>
		<meta charset="utf-8">
	</head>
	<body>

		<?php

			error_reporting(1);

			$nome = "André";
			echo "Olá, <b>$nome</b>!";

			$qtd = $_GET["qtd"];

			if ( $qtd == NULL ) {
				echo "<br>Não passou o parâmetro!";
			}

			echo "<ul>";
			for ($i=1; $i <=$qtd; $i++) {
				echo "<li>";
				echo "Item $i";
				echo "</li>";
			}
			echo "</ul>";


		?>

	</body>
</html>