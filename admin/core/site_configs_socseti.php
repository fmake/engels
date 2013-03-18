<?php
if (!$admin->isLogined())
	die("Доступ запрещен!");
	
	$absitem = new globalConfigs();
	
	//$configs = $absitem->getSiteConfigs();
	//printAr($configs);
	
	switch($request->action){
		case 'change':
			//echo "qq";
			//printAr($_POST);
			foreach ($_POST['configs'] as $key=>$value){
				$absitem ->udateByValue($key, $value);
			}
		break;
		case 'change_vk':
			if($_POST['string_token_vk']){
				preg_match_all('/access_token=(.*)&expires_in=(.*)&user_id=(.*)/',$_POST['string_token_vk'],$array_result);
				$absitem ->udateByValue('token_vk', $array_result[1][0]);
				$absitem ->udateByValue('user_id_vk', $array_result[3][0]);
			}
		break;
		case 'delete_publick':
			switch($_POST['delete_name']){
				case 'vk':
					$absitem ->udateByValue('token_vk', '');
					$absitem ->udateByValue('user_id_vk', '');
					break;
				case 'twitter':
					$absitem ->udateByValue('request_token_twitter', '');
					$absitem ->udateByValue('request_token_secret_twitter', '');
					$absitem ->udateByValue('user_twitter', '');
					break;
				case 'facebook':
					$absitem ->udateByValue('token_fb', '');
					$absitem ->udateByValue('user_id_fb', '');
					break;
			}
		break;
		case 'new':
			foreach ($_POST as $key=>$value){
				$absitem ->addParam($key, $value);
			}
			$absitem -> newItem();
		break;
	}
	
	
# Поля
	$form = new utlFormEngine($modul, "/admin/index.php?modul=".$request->modul);
	$form->formLegend = "Основные параметры";
	$form->addHidden("action", 'change');
		
    $form->addVarchar("<em><b>Вконтакте</b><em>", "configs[link_vk]",$configs->link_vk,100,false,"");
    $form->addVarchar("<em><b>Facebook</b><em>", "configs[link_fb]",$configs->link_fb,100,false,"");
    $form->addVarchar("<em><b>Twitter</b><em>", "configs[link_tw]",$configs->link_tw,100,false,"");    
	$form->addVarchar("<em><b>Yandex виджет</b><em>", "configs[link_ya]",$configs->link_ya,100,false,""); 
	$form->addVarchar("<em><b>YouTube</b><em>", "configs[link_yt]",$configs->link_yt,100,false,"");
	$form->addSubmit("Добавить","Обновить");
	$content .= $form->printForm();
		
	/*публикация Vkontakt*/
	$form = new utlFormEngine($modul, "/admin/index.php?modul=".$request->modul);
	$form->formLegend = "настройка публикации в Вконтакте";
	$form->addHidden("action", 'change_vk');
	//$form->addFCKEditor("<em>Футер</em><br />", "configs[footer]",$configs->footer,"Футер");
	
	$vk = new VKapi();
	$app_id = $vk->thisAppId();
	$tocken = $configs->token_vk;
	$user_id_vk = $configs->user_id_vk;
	$result = $vk->isUserTokenVK($tocken,$user_id_vk);
	switch($result['error']['error_code']){
		case '5':
			$str_status = "<span style='color:red;'>Неактивна (обновить Токен Вконтакте перейдя по ссылке ниже)</span>";
			break;
		default:
			if($user_id_vk && $tocken)
				$str_status = "<span style='color:green;'>Активна</span>";
			else
				$str_status = "<span style='color:red;'>Неактивна (обновить Токен Вконтакте перейдя по ссылке ниже)</span>";
			break;
	}
	$form->addhtml("","<tr><td colspan='2'>Публикация: ".$str_status."</td></tr>");
	$form->addVarchar("<em>Токен Вконтакте</em><br />", "string_token_vk",false,255,false,"");
	$form->addHtml("","<tr><td colspan='2'>(перейдите по <a target='_blank' href='http://oauth.vk.com/authorize?client_id={$app_id}&redirect_uri=http://api.vk.com/blank.html&scope={$app_id}&display=page&response_type=token'>ссылке</a>, разрешить права, скопируйте строчку на странице и вставить в поле)</td></tr>");
	$form->addSubmit("Добавить","Обновить");
	$content .= $form->printForm();
	//http://oauth.vk.com/authorize?client_id=2781028&redirect_uri=http://api.vk.com/blank.html&scope=1008191&display=page&response_type=token
	/*публикация Vkontakt*/
	
	/*удалить публикацию Vkontakt*/
	$form = new utlFormEngine($modul, "/admin/index.php?modul=".$request->modul);
	$form->formLegend = "";
	$form->addHidden("action", 'delete_publick');
	$form->addHidden("delete_name", 'vk');
	$form->addSubmit("Добавить","Удалить публикацию в Vkontakt");
	$content .= $form->printForm();
	/*удалить публикацию Vkontakt*/
	
	/*публикация Twitter*/
	$form = new utlFormEngine($modul, "/admin/index.php?modul=".$request->modul);
	$form->formLegend = "настройка публикации в Twitter";
	$form->addHidden("action", 'change');
	//$form->addFCKEditor("<em>Футер</em><br />", "configs[footer]",$configs->footer,"Футер");
	if($configs->request_token_twitter && $configs->request_token_secret_twitter){
		$str_status = "<span style='color:green;'>Активна</span>";
	}
	else{
		$str_status = "<span style='color:red;'>Неактивна</span>";
	}
	$form->addhtml("","<tr><td colspan='2'>Публикация: ".$str_status."</td></tr>");
	if($configs->user_twitter) $form->addhtml("","<tr><td colspan='2'>Пользователь: <a target='_blank' href='https://twitter.com/#!/".$configs->user_twitter."'>@".$configs->user_twitter."</a></td></tr>");
	//$form->addVarchar("<em>Токен Вконтакте</em><br />", "string_token_vk",false,255,false,"");
	$form->addHtml("","<tr><td colspan='2'>(перейдите по <a href='/twitter.php?action=link'>ссылке</a> и разрешить права)</td></tr>");
	//$form->addSubmit("Добавить","Обновить");
	$content .= $form->printForm();
	/*публикация Twitter*/
	
	/*удалить публикацию Twitter*/
	$form = new utlFormEngine($modul, "/admin/index.php?modul=".$request->modul);
	$form->formLegend = "";
	$form->addHidden("action", 'delete_publick');
	$form->addHidden("delete_name", 'twitter');
	$form->addSubmit("Добавить","Удалить публикацию в Twitter");
	$content .= $form->printForm();
	/*удалить публикацию Twitter*/
	
	/*публикация Facebook*/
	$form = new utlFormEngine($modul, "/admin/index.php?modul=".$request->modul);
	$form->formLegend = "настройка публикации в Facebook";
	$form->addHidden("action", 'change');
	//$form->addFCKEditor("<em>Футер</em><br />", "configs[footer]",$configs->footer,"Футер");
	$fb = new FBapi();
	$tocken = $configs->token_fb;
	//$user_id_fb = $configs->user_id_fb;
	$result = $fb->isUserToken($tocken);
	
	if($configs->token_fb ){ 
		$str_status = "<span style='color:green;'>Активна</span>";
	}
	else{
		$str_status = "<span style='color:red;'>Неактивна</span>";
	}
	$form->addhtml("","<tr><td colspan='2'>Публикация: ".$str_status."</td></tr>");
	if($configs->user_id_fb) $form->addhtml("","<tr><td colspan='2'>Пользователь: <a target='_blank' href='https://facebook.com/".$configs->user_id_fb."'>ссылка напрофиль от чьего имени публикуются сообщения</a></td></tr>");
	//$form->addVarchar("<em>Токен Вконтакте</em><br />", "string_token_vk",false,255,false,"");
	$form->addHtml("","<tr><td colspan='2'>(перейдите по <a href='/fb.php?action=link'>ссылке</a> и разрешить права)</td></tr>");
	$form->addHtml("","<tr><td colspan='2'>Генерация токена администратора ( перейти по <a href='https://graph.facebook.com/412064752192199?fields=access_token&access_token={$configs->token_fb}' target='_blank'>ссылке</a> )</td></tr>");
	$form->addVarchar("Токен администратора группы","configs[token_fb_group_admin]",$configs->token_fb_group_admin);
	$form->addSubmit("Добавить","Обновить");
	$content .= $form->printForm();
	/*публикация Facebook*/
	
	/*удалить публикацию Facebook*/
	
	$form = new utlFormEngine($modul, "/admin/index.php?modul=".$request->modul);
	$form->formLegend = "";
	$form->addHidden("action", 'delete_publick');
	$form->addHidden("delete_name", 'facebook');
	$form->addSubmit("Добавить","Удалить публикацию в Facebook");
	$content .= $form->printForm();
	/*удалить публикацию Facebook*/
		
	$globalTemplateParam -> set('content', $content);
	global $template;
	$template = "admin/edit/simple_edit.tpl";
?>