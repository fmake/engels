<?php

	if (!$user->isLogined()){		
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: /");
	}
	
	//$breadcrubs = $modul->getBreadCrumbs($modul->id);	
	
	switch ($request->action) {
		case 'edit_user_params':
			$fmakeSiteUser = new fmakeSiteUser($user->id);
			
			if ($_FILES['avatar']['tmp_name']) {
				//echo 'qq';
				$fmakeSiteUser->addFile($_FILES['avatar']['tmp_name'], $_FILES['avatar']['name']);
			}
			
			if ($request->name) {
				$fmakeSiteUser->addParam('name',$request->name);
			}
			if ($request->type) {
				$fmakeSiteUser->addParam('type',$request->type);
			}
			
			$fmakeSiteUser->addParam('job',$request->job);
			
			if ($request->id_oblast_ekspert) {
				$fmakeSiteUser->addParam('id_oblast_ekspert',$request->id_oblast_ekspert);
			}
			$fmakeSiteUser->addParam('main_email',$request->main_email);
			if ($request->password || $request->password_succed) {
				if ($request->password == $request->password_succed) {
					$fmakeSiteUser->addParam('password',md5($request->password));	
				} else {
					$error['password'] = "Неверно повторили пароль";
					$globalTemplateParam->set('error_edit_user_params', $error);
				}
			}
			$fmakeSiteUser->update();
			
			/*множественные категории*/
			$fmakeSiteUserMultiple = new fmakeSiteUser_multiple();
			$fmakeSiteUserMultiple->addParents($_POST['parents_oblast_ekspert'],$user->id);
			/*множественные категории*/
			
			if($user->id){
				$fmakeSiteUser = new fmakeSiteUser();
				$fmakeSiteUser->setId($user->id);
				$user_params = $fmakeSiteUser->getInfo();	
			}
			
			$globalTemplateParam->set('user', $user);
			$globalTemplateParam->set('user_params', $user_params);
			
		break;
		case 'add_expert_post':
			//обработка формы и добавление
			$error = false;

			//if(!$request->getEscape('parent')) $error['parent'] = "Выберите категорию";
			if(!$request->getEscape('caption')) $error['caption'] = "Введите название статьи";
			//if(!$request->getEscape('email') || !ereg("^([-a-zA-Z0-9._]+@[-a-zA-Z0-9.]+(\.[-a-zA-Z0-9]+)+)*$", $request->getEscape('email'))) $error['email'] = "Некорректный email";
			//if(!$request->getEscape('phone')) $error['phone'] = "Введите телефон";
			if(!$request->getEscape('text')) $error['text'] = "Введите текст статьи";
			
			
			if(!$error){
				$id_parent = 3823;
				
				$fmakeSiteModulRelation = new fmakeSiteModule_relation();
				$fmakeExpert = new fmakeExpert();

				$fmakeExpert_dop = new fmakeTypeTable();
				$fmakeExpert_dop->table = $fmakeExpert_dop->getTable($id_parent);
								
				$fmakeExpert->addParam("parent",$id_parent);
				$fmakeExpert->addParam("caption",$request->getEscape('caption'));
				$fmakeExpert->addParam("title",$request->getEscape('caption'));
				$fmakeExpert->addParam("redir",$fmakeExpert->transliter($request->getEscape('caption')));
				$fmakeExpert->addParam("text",$request->text);
				$fmakeExpert->addParam("file","item_expert");
				$fmakeExpert->addParam("date_create",time());
				$fmakeExpert->addParam("active",0);
				$fmakeExpert->newItem();
								
				$item_info = $fmakeExpert->getInfo();
				$fmakeExpert->addParam("redir", $item_info['redir'].$fmakeExpert->id);
				$fmakeExpert->update();
				
				$fmakeSiteModulRelation->setPageRelation($id_parent, $fmakeExpert->id);
				
				$fmakeExpert_dop->addParam("id", $fmakeExpert->id);
				$fmakeExpert_dop->addParam("id_user", $user->id);
				$fmakeExpert_dop->addParam("date", time());
									
				$fmakeExpert_dop->newItem();
				
				//if($_FILES['image']['tmp_name'])
				//	$fmakeExpert->addFile($_FILES['image']['tmp_name'], $_FILES['image']['name']);
				
				$add_ok_post = true;
				$add_ok_post_id = $fmakeExpert->id;
				
				$text = "Пришел на модерацию пост от эксперта. <a href=\"http://engels.bz/admin/?modul=adm_expert_post&id={$add_ok_post_id}&action=edit\">{$request->getEscape('caption')}</a>";
				$mail = new PHPMailer();
				
				//include ROOT."/fmake/libs/PHPMailer/connect_smtp.php";
				
				$mail->CharSet = "utf-8";//кодировка
				$mail->From = "info@{$hostname}";
				$mail->FromName = $hostname;
				$mail->AddAddress($configs->email);
				//$mail->AddAddress("mamaev.aleksander@gmail.com");
				$mail->WordWrap = 50;                                 
				$mail->SetLanguage("ru");
				$mail->IsHTML(true);
				$mail->Subject = "Engels.bz";
				$mail->Body    = $text;
				
				//$mail->AltBody = "Если не поддерживает html";
				$mail->Send();
				
				header("HTTP/1.1 301 Moved Permanently");
				header('Location: '.$_SERVER['REQUEST_URI'].'?addpost=1');
				
			}else{
				$globalTemplateParam->set('error_post', $error);
			}
		break;
		case 'add_sms_mailer':
			//обработка формы и добавление
			$error = false;

			if(!$request->getEscape('phones')) $error['phones'] = "Введите телефоны рассылки";
			if(!$request->getEscape('text')) $error['text'] = "Введите текст сообщения";
						
			if(!$error){
				
				$fmakeSmsMailer = new fmakeSmsMailer();
				$fmakeSmsMailer->addParam("id_user", $user->id);
				$fmakeSmsMailer->addParam("phones",$request->phones);
				$fmakeSmsMailer->addParam("text",$request->text);
				$fmakeSmsMailer->addParam("date_create",time());
				$fmakeSmsMailer->addParam("active",0);
				$fmakeSmsMailer->newItem();
												
				$add_ok_sms_mailer = true;
								
				header("HTTP/1.1 301 Moved Permanently");
				header('Location: '.$_SERVER['REQUEST_URI'].'?addsmsmailer=1');
				
			}else{
				$globalTemplateParam->set('error_sms_mailer', $error);
			}
		break;
		default:
		break;
	}
	
	/*темы эксперртов*/
	$manual_obj = new fmakeManual();
	$cat = $manual_obj->getCatForMenu(1238,true);
	$globalTemplateParam->set('categories', $cat);
	/*темы эксперртов*/
	
	//printAr($user_params);
	if ($user_params['type'] == 'ekspert') {
		$expert_obj = new fmakeExpert();
		$expert_obj->order = "b.date DESC, a.id";
		$items = $expert_obj->getByPageAdmin(3823, false, false,"b.`id_user` = {$user->id} and a.`file` = 'item_expert'",false);
		//echo 'qq';
		//printAr($items);
		$globalTemplateParam->set('items', $items);
	}
	
	$fmakeSmsMailer = new fmakeSmsMailer();
	$sms_mailer_items = $fmakeSmsMailer->getItemsUserId($user->id);
	$globalTemplateParam->set('sms_mailer_items', $sms_mailer_items);
	
	$fmakeSiteUserMultiple = new fmakeSiteUser_multiple();
	$globalTemplateParam->set('fmakeSiteUserMultiple', $fmakeSiteUserMultiple);
	
	/*Реклама на сайте*/
	$fmakeBanerContent = new fmakeBanerContent();
	$fmakeProjectCommercial = new fmakeProjectCommercial();
	$fmakeProjectCommercialRelation = new fmakeProjectCommercial_relation();
	$comercial_project = $fmakeProjectCommercial->getProjectToUserId($user->id);
	if($comercial_project){
		$id_baners = $fmakeProjectCommercialRelation->getContentId($comercial_project['id']);
		if($id_baners) $items_baners = $fmakeBanerContent->getByPageAdmin(5585, false,1,"a.id in ( {$id_baners} ) AND a.`file` = 'item_baner'",true);
		$use_price = 0;
		if($items_baners)foreach($items_baners as $key=>$item){
			$use_price += $item[use_price];
		}
		$globalTemplateParam->set('baners_user_used', $items_baners);
		$globalTemplateParam->set('baners_use_price', $use_price);
	}
	/*Реклама на сайте*/
	
	//$globalTemplateParam->set('breadcrubs', $breadcrubs);
	$modul->template = "user/edit.tpl";
	
?>