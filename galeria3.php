<html>
<head>
<title>Seu Titulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body text="#000000" link="#000000" vlink="#000000" alink="#000000">
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td colspan="2"><div align="center"> 
        Cabecalho aqui </div></td>
  </tr>
  <tr> 
    <td width="22%" height="37" valign="top"> 
      Menu lateral aqui </td>
    <td valign="top"> <p align="center"> <?php
// Conexao com o BD
include "conecta_mysql.inc";
// Pegar a pagina atual por GET
$p = $INPUT_GET["p"];
$datas = $INPUT_GET["data"];
// Verifica se a variavel esta declarada, senao deixa na primeira pagina como padrao
if(isset($p)) {
$p = $p;
} else {
$p = 1;
}
// Defina aqui a quantidade maxima de registros por pagina.
$qnt = 1;
// O sistema calcula o inicio da selecaoo calculando: 
// (pagina atual * quantidade por pagina) - quantidade por pagina
$inicio = ($p*$qnt) - $qnt;
// consulta apenas os registros da pagina em que estao utilizando como auxilio a definicao LIMIT. Ordene os registros pela quantidade de pontos, comecando do maior para o menor DESC.
$consulta = "SELECT * FROM fotos where data='$datas' and status='Sim' order by id LIMIT $inicio, $qnt";
// executar query
// bloco 5 - exiba os registros na tela
//echo "<ul>";
$query = mysql_query($consulta);
while (list($id,$evento,$comentario,$path,$data,$data_cad,$data_alt,$ip,$status) = mysql_fetch_array($query))//Por ser uma lista, os sampos devem ser seguidos conforme a sequencia no Banco de Dados. Caso nao queira todos os campos, deixar espacos em branco
{
echo'<br>';
echo'<p align="center"><font size="4" face="Verdana">'.$evento.'</font></font></p>';
  echo'<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF"><tr>
    <td height="2"><div align="center"><img src="'.$path.'" width="450" height="350" border="10"></div></td>
  </tr>
  <tr>
    <td height="2"><div align="center" class="style1 style2">'.$comentario.'</div></td>
  </tr>';
}
echo'</table>';

// Depois que selecionou todos os nome, pula uma linha para exibir os links(pr�xima, �ltima...)
echo "<br />";

// Faz uma nova sele��o no banco de dados, desta vez sem LIMIT, 
// para pegarmos o n�mero total de registros
$sql_select_all = "SELECT * FROM fotos where data='$datas' and status='Sim' order by id";
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
echo "<p align=\"center\"><font color=\"#000000\" size=\"2\" face=\"Arial, Helvetica, sans-serif\"><strong><a href='galeria3.php?p=1&data=".$datas."' target='_self'>Primeira P�gina</a> ";
// Cria um for() para exibir os 3 links antes da p�gina atual
for($i = $p-$max_links; $i <= $p-1; $i++) {
// Se o n�mero da p�gina for menor ou igual a zero, n�o faz nada
// (afinal, n�o existe p�gina 0, -1, -2..)
if($i <=0) {
//faz nada
// Se estiver tudo OK, cria o link para outra p�gina
} else {
echo "<a href='galeria3.php?p=".$i."&data=".$datas."' target='_self'>".$i."</a> ";
}
}
// Exibe a p�gina atual, sem link, apenas o n�mero
echo $p." ";
// Cria outro for(), desta vez para exibir 3 links ap�s a p�gina atual
for($i = $p+1; $i <= $p+$max_links; $i++) {
// Verifica se a p�gina atual � maior do que a �ltima p�gina. Se for, n�o faz nada.
if($i > $pags)
{
//faz nada
}
// Se tiver tudo Ok gera os links.
else
{
echo "<a href='galeria3.php?p=".$i."&data=".$datas."' target='_self'>".$i."</a> ";
}
}
// Exibe o link "�ltima p�gina"
echo "<a href='galeria3.php?p=".$pags."&data=".$datas."' target='_self'>�ltima P�gina</a></strong></font></p> ";
?> 
</p>
      <div align="center"></div>
      <div align="center"></div>
      <div align="center"></div>    </td>
  </tr>
  <tr> 
    <td height="18" colspan="2"> <div align="center"> 
        Rodap&eacute; aqui </div></td>
  </tr>
</table>
</body>
</html>