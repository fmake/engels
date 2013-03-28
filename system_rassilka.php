<?php
header('Content-type: text/html; charset=utf-8'); 

setlocale(LC_ALL, 'ru_RU.UTF-8');
mb_internal_encoding('UTF-8');

//ini_set('display_errors',1);
//error_reporting(7);
session_start();

	require('./fmake/FController.php');
	$key = "1o0r2i9f3l8a4m7e56";
	if($key!=$_GET['key']){
		$fmakeSiteUser = new fmakeMail(); 
		$fmakeRassilka = new fmakeRassilka();
		$news_obj = new fmakeSiteModule();
		$date = strtotime("today");
		$date = strtotime("-1 days", $date);
		$news_obj->order = "b.date DESC, a.id";
		$time = strtotime("-1 days",time());
		$date_new = mktime(0,0,0,date('m',$time),date('d',$time),date('Y',$time));
		$items = $news_obj->getByPageAdmin(2, false, false,
			"a.`file` = 'item_news' and b.`date` > {$date}",true);
		foreach ($items as $key => $value) {
			$items[] = date("d.m.Y", $items_news_lent[$key]['date']);
		}
		if ($items){
				$fmakeRassilka->addParam('date',$date_new);
				$fmakeRassilka->addParam('date_create',time());
				$fmakeRassilka->addParam('count_item',sizeof($items));
				$fmakeRassilka->newItem();
		}
		PrintAr($items);
	}
/*
header('Content-type: text/html; charset=utf-8'); 

setlocale(LC_ALL, 'ru_RU.UTF-8');
mb_internal_encoding('UTF-8');

ini_set('display_errors',1);
error_reporting(7);
session_start();

	require('./libs/FController.php');
	$key = "1o0r2i9f3l8a4m7e56";
	if($key==$_GET['key']){
		$fmakeSiteUser = new fmakeSiteUser(); 
		$fmakeRassilka = new fmakeRassilka();
		$fmakeNews = new fmakeNews();
		//$num_w = date('w',time());
		$time = strtotime("-1 days",time());
		//echo(date('H:i d.m.Y',$fmakeRassilka->isLastDate()));
		//if($num_w==1 && $fmakeRassilka->isLastDate()<$time){
			$date_new = mktime(0,0,0,date('m',$time),date('d',$time),date('Y',$time));
			//$date_new = date('H:i d.m.Y',$time);
			$items = $fmakeNews->getNewsRassilka($date_new,true);
			if($items){
				$fmakeRassilka->addParam('date',$date_new);
				$fmakeRassilka->addParam('date_create',time());
				$fmakeRassilka->addParam('count_item',sizeof($items));
				$fmakeRassilka->newItem();
				
				$fmakeMessages = new fmakeMessages();
				$fmakeMessages->setId(4);
				$_messages = $fmakeMessages->getInfo();
				
				$globalTemplateParam->set('items', $items);
				$globalTemplateParam->set('hostname',$hostname);
							
				$users_all = $fmakeSiteUser->getAllRassilka(true);
				//echo($_messages['template']);
				foreach($users_all as $item_user){
					//echo($item_user['email']."<br/>");
					$globalTemplateParam->set('item_user', $item_user);
					
					$tmp = $twig->getLoader();
					$twig->setLoader(new Twig_Loader_String());
					$text = $twig->loadTemplate($_messages['template'])->render($globalTemplateParam->get());
					$twig->setLoader($tmp);
					
					$mail = new PHPMailer(); 
					$mail->CharSet = "utf-8";//кодировка
					$mail->From = "info@{$hostname}";
					$mail->FromName = $hostname;
					
					//$mail->AddAddress($item_user['email']);
					$mail->AddAddress("Obuto3@gmail.com");
					
					
					$mail->WordWrap = 50;                                 
					$mail->SetLanguage("ru");
				
					$mail->IsHTML(true);
					
					$mail->Subject = $_messages['title'];
					$mail->Body    = $text;
					//$mail->AltBody = "Если не поддерживает html";
					
					if(!$mail->Send())
					{
					   //echo "Message could not be sent. <p>";
					   //echo "Mailer Error: " . $mail->ErrorInfo;
					}
				}
			}
		//}
	}
*/