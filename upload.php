<!DOCTYPE html>



   <?php
include("menu.html");
//Pegar os dados
	$evento= $_POST["evento"];
	$dia=$_POST["dia"];
	$mes=$_post["mes"];
	$comentario=$_post["comentario"];
	$ano=$_post["ano"];
	$data=$ano.$mes.$dia;
	$data_cad=date('Y-m-d');
	$data_alt=date('Y-m-d');
	$ip=getenv("REMOTE_ADDR");//Guarda o ip da m�quina que insere o an�ncio
	$status = "Sim";

//se existir o arquivo
if(isset($_FILES["arquivo"]))
{
	$arquivo = $_FILES["arquivo"];
	$pasta_dir = "arquivos/";//diretorio dos arquivos
	//se n�o existir a pasta ele cria uma
	if(!file_exists($pasta_dir))
	{
		mkdir($pasta_dir);
	}
	$arquivo_nome = $pasta_dir . $arquivo["name"];
	// Faz o upload da imagem
	move_uploaded_file($arquivo["tmp_name"], $arquivo_nome);
	//conecta no banco
	include "conecta_mysql.inc";
	//Gravar o path no banco
	mysqli_query("INSERT INTO fotos VALUES ('','$evento','$comentario','$arquivo_nome','$data','$data_cad','$data_alt','$ip','$status')"); 
		echo'<br>';
	    echo '<p align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>UPLOAD REALIZADO COM SUCESSO!!</strong></font></p>';
	    echo '<p align="center"><a href="#" onClick="history.back();"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>&lt;&lt; 
                CADASTRAR OUTRA FOTO PARA O MESMO EVENTO&gt;&gt;</strong></font></a><p></p>';
		echo '<p align="center"><a href="upload_form.php" target="_parent"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>&lt;&lt;CADASTRAR FOTO PARA OUTRO EVENTO&gt;&gt;</strong></font></a></p>'; 
		echo '<p align="center"><a href="galeria.php" target="_parent"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>&lt;&lt;GALERIA&gt;&gt;</strong></font></a></p>'; 
}
else
{
		echo'<br>';
		echo "<p align=\"center\">N�o foi poss�vel realizar o cadastro da imagem no �lbum!!</p>";
	    echo '<p align="center"><a href="#" onClick="history.back();"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>&lt;&lt; 
                VOLTAR</strong></font></a><p></p>';

}
mysqli_close(0);//fecha a conex�o com o banco de dados

?>
</body>
</html>
