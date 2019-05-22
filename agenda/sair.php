<?php

// Inicializa a sessão
session_start();

// Apaga todas as variáveis na sessão
session_destroy();

// Volta para o login
header("Location: index.php");

?>