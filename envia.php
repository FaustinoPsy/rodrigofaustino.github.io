<body>
<?php
 
$nomeremetente     = $_POST['nomeremetente'];
$emailremetente    = $_POST['emailremetente'];
$emaildestinatario = "contato@rodrigofaustino.com.br";

$assunto           = $_POST['assunto'];
$mensagem          = $_POST['mensagem'];

 if($nomeremetente==''||$emailremetente==''||$mensagem==''){

print "<h4>o email n�o poder� ser enviado, falta dados no formul�rio<br><br>


<p><a href='".$_SERVER["HTTP_REFERER"]."'>Voltar</a></p></h4>";

}
else{
	
 
/* Verifica qual �o sistema operacional do servidor para ajustar o cabe�alho de forma correta.  */
if(PATH_SEPARATOR == ";") $quebra_linha = "\r\n"; //Se for Windows
else $quebra_linha = "\n"; //Se "não for Windows"
 
// Passando os dados obtidos pelo formul�rio para as vari�veis abaixo

 
 
/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = '<P>Contato do site PHP mail();!</P>
<P>Aqui est� a mensagem postada; formatada em HTML:</P>
<p><b>Nome: <i>'.$nomeremetente.'</i></b></p>
<p><b>email: <i>'.$emailremetente.'</i></b></p>
<p><b>Assunto: <i>'.$assunto.'</i></b></p>
<p><b>Mensagem: <i>'.$mensagem.'</i></b></p>
<hr>';
 
 
/* Montando o cabeçalho da mensagem */
$headers = "MIME-Version: 1.1" .$quebra_linha;
$headers .= "Content-type: text/html; charset=iso-8859-1" .$quebra_linha;
// Perceba que a linha acima cont�m "text/html", sem essa linha, a mensagem n�o chegar� formatada.
$headers .= "From: " . $emailsender.$quebra_linha;
$headers .= "Cc: " . $comcopia . $quebra_linha;
$headers .= "Bcc: " . $comcopiaoculta . $quebra_linha;
$headers .= "Reply-To: " . $emailremetente . $quebra_linha;
// Note que o e-mail do remetente ser� usado no campo Reply-To (Responder Para)
 
/* Enviando a mensagem */

//� obrigat�rio o uso do par�metro -r (concatena��o do "From na linha de envio"), aqui na Locaweb:

if(!mail($emaildestinatario, $assunto, $mensagemHTML, $headers ,"-r".$emailsender)){ // Se for Postfix
    $headers .= "Return-Path: " . $emailsender . $quebra_linha; // Se "n�o for Postfix"
    mail($emaildestinatario, $assunto, $mensagemHTML, $headers );
}
 
/* Mostrando na tela as informa��es enviadas por e-mail */
print "Assunto <b>$assunto</b> enviada com sucesso!<br><br>
<p>Em breve entrarei em contato</p><br>

<p><a href='".$_SERVER["HTTP_REFERER"]."'>Voltar</a></p>";
	

echo "<meta http-equiv='Refresh' content='2;url=#'>";	
	
}
?>
</body>