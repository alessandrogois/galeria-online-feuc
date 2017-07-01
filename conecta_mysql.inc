<?php

//Dados
$host = "localhost";
$usuario = "root";
$senha = "";
$dbname = "galeria";

// Mensagens de Erro
$msg[0] = "<p style=\"font-family: Arial;\">A conex&#227;o com o banco de dados falhou, por gentileza contacte o administrador.</p>";
$msg[1] = "<p style=\"font-family: Arial;\">N&#227;o foi poss&#237;vel selecionar o banco de dados, por gentileza contacte o administrador.</p>";

// Fazendo a conex&#227;o com o servidor MySQL
$conexao=mysqli_connect("$host","$usuario","$senha") or die($_msg[0]);
mysqli_select_db($conexao, $dbname) or die($msg[1]);

