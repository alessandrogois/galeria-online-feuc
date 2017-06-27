<?php

//Dados
$mysql_host = "localhost";
$mysql_bd = "galeria";
$mysql_usuario = "root";
$mysql_senha = "";

// Mensagens de Erro
$mysql_msg[0] = "<p style=\"font-family: Arial;\">A conex&#227;o com o banco de dados falhou, por gentileza contacte o administrador.</p>";
$mysql_msg[1] = "<p style=\"font-family: Arial;\">N&#227;o foi poss&#237;vel selecionar o banco de dados, por gentileza contacte o administrador.</p>";

// Fazendo a conex&#227;o com o servidor MySQL
$mysql_conexao = mysql_connect("$mysql_host","$mysql_usuario","$mysql_senha") or die($mysql_msg[0]);
mysql_select_db("$mysql_bd",$mysql_conexao) or die($mysql_msg[1]);

