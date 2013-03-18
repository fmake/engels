<?php
	switch ($request->action){
		case 'comments':
			if($user->id){
				$text = $request->getEscape('text');

				if ($user_params['name']) {
					$name = $user_params['name'];
				} elseif($user_params['name_social']) {
					$name = $user_params['name_social'];
				} else {
					$name = $user_params['login'];
				}
				
				if($_SESSION['code']!=md5($_REQUEST['picode'])) $error['comment']['code'] = 'Неправильно введен код';
				if(!$text) $error['comment']['text'] = 'Введите сообщение';
				
				if(!$error){
					$post_id = $request->getEscape('id');
					$fmakeComments = new fmakeComments_expert();
					$fmakeComments->addParam("name",$name);
					$fmakeComments->addParam("id_content",$include_param_id_comment);
					$fmakeComments->addParam("id_user",$user->id);
					$fmakeComments->addParam("text",$text);
					$fmakeComments->addParam("date",time());
					$fmakeComments->addParam("active",1);
					$fmakeComments->newItem();
					$send_comment = true;
					$globalTemplateParam->set('send_comment',$send_comment);
					$request->name = $request->text = false;
									
					$fmakeSiteModulComm = new fmakeSiteModule($include_param_id_comment);
					$info_page = $fmakeSiteModulComm->getInfo();
					$id_page_modul = $modul->id;
					$fmakeTypeTable = new fmakeTypeTable();
					$absitem_dop = new fmakeTypeTable();
					$absitem_dop->table = $fmakeTypeTable->getTable($id_page_modul);
					$absitem_dop->setId($info_page[$fmakeSiteModulComm->idField]);
					$info_page_dop = $absitem_dop->getInfo();
					
					$fmakeUser = new fmakeSiteUser($info_page_dop['id_user']);
					$info_user = $fmakeUser->getInfo();
					
					if ($info_user['main_email']) {
						$text = "Добавлен комментарий на Ваш пост <a href=\"http://engels.bz{$info_page[full_url]}\">{$info_page[caption]}</a> на сайте engels.bz .";
						$mail = new PHPMailer();
						
						//include ROOT."/fmake/libs/PHPMailer/connect_smtp.php";
						
						$mail->CharSet = "utf-8";//кодировка
						$mail->From = "info@{$hostname}";
						$mail->FromName = $hostname;
						$mail->AddAddress($info_user['main_email']);
						//$mail->AddAddress("mamaev.aleksander@gmail.com");
						$mail->WordWrap = 50;                                 
						$mail->SetLanguage("ru");
						$mail->IsHTML(true);
						$mail->Subject = "Engels.bz";
						$mail->Body    = $text;
						
						//$mail->AltBody = "Если не поддерживает html";
						$mail->Send();
					}
				}
				$globalTemplateParam->set('error',$error);
			}
		break;
		case 'answer_expert':
			$error = false;
			$text = $request->getEscape('answer');
			
			if(!$text) $error['answer']['text'] = 'Введите комментарий';
			
			if(!$error){
				$post_id = $request->getEscape('comment');
				$fmakeComments = new fmakeComments_expert($post_id);
				$fmakeComments->addParam("answer",$text);
				$fmakeComments->update();
				//$request->name = $request->text = false;
				$info_comment = $fmakeComments->getInfo();
				$fmakeSiteModulComm = new fmakeSiteModule($info_comment['id_content']);
				$info_page = $fmakeSiteModulComm->getInfo();
				$id_page_modul = $modul->id;
				$fmakeTypeTable = new fmakeTypeTable();
				$absitem_dop = new fmakeTypeTable();
				$absitem_dop->table = $fmakeTypeTable->getTable($id_page_modul);
				$absitem_dop->setId($info_page[$fmakeSiteModulComm->idField]);
				$info_page_dop = $absitem_dop->getInfo();
				
				$fmakeUser = new fmakeSiteUser($info_comment['id_user']);
				$info_user = $fmakeUser->getInfo();

				if ($info_user['main_email']) {		
					$text = "Добавлен ответ на Ваш комментарий в статье <a href=\"http://engels.bz{$info_page[full_url]}\">{$info_page[caption]}</a> на сайте engels.bz .";
					$mail = new PHPMailer();
					
					//include ROOT."/fmake/libs/PHPMailer/connect_smtp.php";
					
					$mail->CharSet = "utf-8";//кодировка
					$mail->From = "info@{$hostname}";
					$mail->FromName = $hostname;
					$mail->AddAddress($info_user['main_email']);
					//$mail->AddAddress("mamaev.aleksander@gmail.com");
					$mail->WordWrap = 50;                                 
					$mail->SetLanguage("ru");
					$mail->IsHTML(true);
					$mail->Subject = "Engels.bz";
					$mail->Body    = $text;
					
					//$mail->AltBody = "Если не поддерживает html";
					$mail->Send();
				}
			} else {
				$globalTemplateParam->set('error_answer',$error['answer']);
			}
		break;
	}
	
	
	$limit_comment = 10;
	
	$fmakeComments = new fmakeComments_expert();
	$comments = $fmakeComments->getByPage($include_param_id_comment,$limit_comment,1,true);
	$count = $fmakeComments->getByPageCount($include_param_id_comment,true);
	$pages = ceil($count/$limit_comment);
	if($pages>1) $is_more_link = true;
	else $is_more_link = false;
	
	if ($comments) foreach($comments as $k=>$c) {
		$fmakeSiteUser = new fmakeSiteUser();
		$fmakeSiteUser->setId($c['id_user']);
		$user_params = $fmakeSiteUser->getInfo();
		$comments[$k]['user_params'] = $user_params;
		$comments[$k]['text'] = stripslashes($c['text']);
	}
	
	$globalTemplateParam->set('comments',$comments);
	$globalTemplateParam->set('limit_comment',$limit_comment);
	$globalTemplateParam->set('include_param_id_comment',$include_param_id_comment);
	$globalTemplateParam->set('is_more_link',$is_more_link);