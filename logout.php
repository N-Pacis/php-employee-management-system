<?php

// Inicia a sessão
session_start();

// Remove as variáveis de sessão
unset($_SESSION['username']);

// Encerra a sessão
session_destroy();

// Redireciona o usuário para a página de login
header("Location: login.php");

?>
