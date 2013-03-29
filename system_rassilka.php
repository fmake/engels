<?php
header('Content-type: text/html; charset=utf-8'); 

setlocale(LC_ALL, 'ru_RU.UTF-8');
mb_internal_encoding('UTF-8');

//ini_set('display_errors',1);
//error_reporting(7);
session_start();

	require('./fmake/FController.php');
	$key = "1o0r2i9f3l8a4m7e56";
	if($key == $_GET['key']){
		$fmakeMail = new fmakeMail(); 
		$fmakeRassilka = new fmakeRassilka();
		$news_obj = new fmakeSiteModule();
		$date = strtotime("today");
		$date = strtotime("-1 days", $date);
		$news_obj->order = "b.date DESC, a.id";
		$time = strtotime("-1 days",time());
		$date_new = mktime(0,0,0,date('m',$time),date('d',$time),date('Y',$time));
		$items = $news_obj->getByPageAdmin(2, false, false,
			"a.`file` = 'item_news' and b.`date` > {$date}",true);
		if ($items){
			$fmakeRassilka->addParam('date',$date_new);
			$fmakeRassilka->addParam('date_create',time());
			$fmakeRassilka->addParam('count_item',sizeof($items));
			$fmakeRassilka->newItem();
			$fmakeMessages = new fmakeMessages();
			$fmakeMessages->setId(3);
			$_messages = $fmakeMessages->getInfo();
			$globalTemplateParam->set('items', $items);
			$globalTemplateParam->set('hostname',$hostname);
			$mail_all = $fmakeMail->getAll(true);
			foreach($mail_all as $item_user){
				$globalTemplateParam->set('item_user', $item_user);
				$tmp = $twig->getLoader();
				$twig->setLoader(new Twig_Loader_String());
				$text = $twig->loadTemplate($_messages['template'])->render($globalTemplateParam->get());
				$twig->setLoader($tmp);
				$mail = new PHPMailer(); 
				$mail->CharSet = "utf-8";
				$mail->From = "info@{$hostname}";
				$mail->FromName = $hostname;
				$mail->AddAddress($item_user['mail']);
				//$mail->AddAddress("Obuto3@gmail.com");
				$mail->WordWrap = 50;                                 
				$mail->SetLanguage("ru");
				$mail->IsHTML(true);
				$mail->Subject = $_messages['title'];
				$mail->Body    = $text;	
				if(!$mail->Send())
					{
					   echo "Message could not be sent. <p>";
					   echo "Mailer Error: " . $mail->ErrorInfo;
					}
			}
		}
		//PrintAr($mail_all);
		//PrintAr($items);
	}