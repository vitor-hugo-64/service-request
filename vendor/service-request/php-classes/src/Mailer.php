<?php

namespace SR;

use Rain\Tpl;

class Mailer
{

	const EMAIL = "EMAIL_DO_REMETENTE";
	const PASSWORD = "SENHA_DO_REMETENTE";
	const NAME = "NOME_DO_REMETENTE";

	private $mail;

	function __construct( $toAddress, $toName, $subject, $tplName, $data = array())
	{

		$config = array( 
			'tpl_dir' => 'views'.DIRECTORY_SEPARATOR, 
			'cache_dir' => 'views-cache'.DIRECTORY_SEPARATOR 
		);

		Tpl::configure( $config );
		
		$tpl = new Tpl();

		foreach ($data as $key => $value) {
			$tpl->assign( $key, $value);
		}

		$html = $tpl->draw( $tplName, true);

		$this->mail = new \PHPMailer;

		$this->mail->isSMTP();

		$this->mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);

		$this->mail->SMTPDebug = 0;

		$this->mail->Host = 'smtp.gmail.com';

		$this->mail->Port = 587;

		$this->mail->SMTPSecure = 'tsl';

		$this->mail->SMTPAuth = true;

		$this->mail->Username = Mailer::EMAIL;

		$this->mail->Password = Mailer::PASSWORD;

		$this->mail->setFrom( Mailer::EMAIL, Mailer::NAME);

		$this->mail->addAddress( $toAddress, $toName);

		$this->mail->Subject = $subject;

		$this->mail->msgHTML( $html);

		$this->mail->AltBody = 'Erro No Corpo Do Texto!';
	}

	public function send()
	{
		$this->mail->CharSet = 'utf-8';
		$this->mail->send();
	}

}