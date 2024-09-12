<?php

// Coloque o email de contato aqui
$php_main_email = "example@gmail.com";

// Recebendo valores do formulário
$php_name = $_POST['ajax_name'];
$php_email = $_POST['ajax_email'];
$php_message = $_POST['ajax_message'];



// Sanitizando o email
$php_email = filter_var($php_email, FILTER_SANITIZE_EMAIL);


// Após a sanitização, é realizada a validação
if (filter_var($php_email, FILTER_VALIDATE_EMAIL)) {
	
	
		$php_subject = "Mensagem do formulário de contato";
		
		// Para enviar e-mails em HTML, o cabeçalho Content-type deve ser configurado
		$php_headers = 'MIME-Version: 1.0' . "\r\n";
		$php_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$php_headers .= 'De:' . $php_email. "\r\n"; // Email do remetente
		$php_headers .= 'Cc:' . $php_email. "\r\n"; // Cópia para o remetente
		
		$php_template = '<div style="padding:50px;">Olá ' . $php_name . ',<br/>'
		. 'Obrigado por entrar em contato conosco.<br/><br/>'
		. '<strong style="color:#f00a77;">Nome:</strong>  ' . $php_name . '<br/>'
		. '<strong style="color:#f00a77;">Email:</strong>  ' . $php_email . '<br/>'
		. '<strong style="color:#f00a77;">Mensagem:</strong>  ' . $php_message . '<br/><br/>'
		. 'Este é um email de confirmação de contato.'
		. '<br/>'
		. 'Entraremos em contato o mais breve possível.</div>';
		$php_sendmessage = "<div style=\"background-color:#f5f5f5; color:#333;\">" . $php_template . "</div>";
		
		// As linhas da mensagem não devem exceder 70 caracteres (regra do PHP), então será quebrada
		$php_sendmessage = wordwrap($php_sendmessage, 70);
		
		// Enviar email usando a função mail do PHP
		mail($php_main_email, $php_subject, $php_sendmessage, $php_headers);
		echo "";
	
	
} else {
	echo "<span class='contact_error'>* Email inválido *</span>";
}

?>