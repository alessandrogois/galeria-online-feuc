<html>
<head>
<title>Seu titulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body text="#000000" link="#000000" vlink="#000000" alink="#000000">
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td colspan="2"><div align="center"> 
        Cabecalho aqui </div></td>
  </tr>
   <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="index.html">
GALERIA VIRTUAL                    </a>
                </li>
                <li>
                    <a href="galeria.php">Galeria</a>
                </li>
                <li>
                    <a href="upload.php">Upload de fotos</a>
                </li>
                 <li>
                    <a href="#">Sobre nós</a>
                </li>
                <li>
                    <a href="#">Serviços</a>
                </li>
                <li>
                    <a href="#">Contato</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
    <td valign="top"> <p align="center">
	
	 <?php
// Conex�o com o BD
include "conecta_mysql.inc";
// Pegar a p�gina atual por GET
$p = $IMPUT_GET["p"];
// Verifica se a variavel ta declarada, senao deixa na primeira pagina como padrao
if(isset($p))
{
	$p = $p;
}
else
{
	$p = 1;
}
// Defina aqui a quantidade maxima de registros por pagina.
$qnt = 10;
// O sistema calcula o inicio da selecao calculando: 
// (pagina atual * quantidade por p�gina) - quantidade por pagina
$inicio = ($p*$qnt) - $qnt;
// Seleciona no banco de dados com o LIMIT indicado pelos numeros acima
$sql_select = "SELECT * FROM fotos where status='Sim' GROUP BY evento ORDER BY data desc LIMIT $inicio, $qnt";
// Executa o Query
$sql_query = mysql_query($sql_select);
echo'<br>';
// executar query
if ($sql_query==0)
{
	echo'<br>';
	echo'<p align="center"><font size="2" face="Verdana"><strong>GALERIA DE FOTOS VAZIA</strong></font></p>';
	exit;

}
else
{
	// bloco 5 - exiba os registros na tela
	echo'<p align="center"><font size="4" face="Verdana">GALERIA DE FOTOS</font></p>';
	echo'<form name="form1" method="get" action="galeria3.php" target="_parent">';
	echo'<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1">
  	<tr> 
    <td width="15%" height="16" valign="middle" bgcolor="#4F7DB0"> 
    <div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>DATA</strong></font></div></td>
	<td width="85%" height="16" valign="middle" bgcolor="#4F7DB0"> 
    <div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>EVENTO</strong></font></div></td>
  	</tr>
	</table>';//T�tulo da tabela//T�tulo da tabela';;
	while (list($id,$evento,$comentario,$path,$data,$data_cad,$data_alt,$ip,$status) = mysql_fetch_array($sql_query))//Por ser uma lista, os sampos devem ser seguidos conforme a sequ�ncia no Banco de Dados. Caso n�o queira todos os campos, deixar espa�os em branco
 		{
			//echo "<li> $titulo - $autor";
			//echo'<body text="#FFFFFF" link="#FFFFFF" vlink="#000066" alink="#FFFFFF">
			echo'<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1"><tr> 
    		<td width="15%" height="16" valign="middle" bgcolor="#D9E3EE"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a href="galeria3.php?data='.$data.'" target="_parent">'.date('d/m/Y',strtotime($data)).'</a></font></div></td>
    		<td width="85%" height="16" valign="middle" bgcolor="#D9E3EE"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a href="galeria3.php?data='.$data.'" target="_parent">'.$evento.'</a></font></div></td>
  			</tr>
			</table>';
 		}

 echo'</form>';
// Depois que selecionou todos os nome, pula uma linha para exibir os links(pr�xima, �ltima...)
echo "<br />";
// Faz uma nova sele��o no banco de dados, desta vez sem LIMIT, 
// para pegarmos o n�mero total de registros
$sql_select_all = "SELECT * FROM fotos where status='Sim' GROUP BY evento ORDER BY data desc";
// Executa o query da sele��o acimas
$sql_query_all = mysql_query($sql_select_all);
// Gera uma vari�vel com o n�mero total de registros no banco de dados
$total_registros = mysql_num_rows($sql_query_all);
// Gera outra vari�vel, desta vez com o n�mero de p�ginas que ser� precisa. 
// O comando ceil() arredonda 'para cima' o valor
$pags = ceil($total_registros/$qnt);
// N�mero m�ximos de bot�es de pagina��o
$max_links = 3;
// Exibe o primeiro link 'primeira p�gina', que n�o entra na contagem acima(3)
echo "<p align=\"center\"><font color=\"#000000\" size=\"2\" face=\"Arial, Helvetica, sans-serif\"><strong><a href='galeria.php?p=1' target='_self'>Primeira P�gina</a> ";
// Cria um for() para exibir os 3 links antes da p�gina atual
for($i = $p-$max_links; $i <= $p-1; $i++)
{
	// Se o n�mero da p�gina for menor ou igual a zero, n�o faz nada
	// (afinal, n�o existe p�gina 0, -1, -2..)
	if($i <=0)
	{
		//faz nada
		// Se estiver tudo OK, cria o link para outra p�gina
	}
	else
	{
		echo "<a href='galeria.php?p=".$i."' target='_self'>".$i."</a> ";
	}
}
// Exibe a p�gina atual, sem link, apenas o n�mero
echo $p." ";
// Cria outro for(), desta vez para exibir 3 links ap�s a p�gina atual
for($i = $p+1; $i <= $p+$max_links; $i++)
{
	// Verifica se a p�gina atual � maior do que a �ltima p�gina. Se for, n�o faz nada.
	if($i > $pags)
	{
		//faz nada
	}
	// Se tiver tudo Ok gera os links.
	else
	{
		echo "<a href='galeria.php?p=".$i."' target='_self'>".$i."</a> ";
	}
}
// Exibe o link "�ltima p�gina"
echo "<a href='galeria.php?p=".$pags."' target='_self'>�ltima P�gina</a></strong></font></p> ";
}//Fim do else
?>
        </p></td>
  </tr>
  <tr> 
    <td height="18" colspan="2"> <div align="center"> 
        Rodape; aqui </div></td>
  </tr>
</table>
 <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
</body>
</html>
