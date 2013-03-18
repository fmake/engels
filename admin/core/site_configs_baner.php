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
	$form->formLegend = "Текстовые блоки";
	$form->addHidden("action", 'change');
	
	$form->addTextArea("<em>Блок справа</em><br />", "configs[right_block]",$configs->right_block,"Баннер справа");
	//$form->addTinymce("<em>Правый блок под виджетами</em><br />", "configs[right_text_block]",$configs->right_text_block,"Правый блок под виджетами");
	
	$form->addTinymce("<em>Главный баннер</em>(347x76)<br />", "configs[main_banner]",$configs->main_banner,"Главный баннер");
	$form->addTinymce("<em>Баннер на главной поцентру (609x133)</em><br />", "configs[center_main_block]",$configs->center_main_block,"Баннер на главной поцентру");
	$form->addTinymce("<em>Баннер на главной справа</em>(347x76)<br />", "configs[right_baner_block]",$configs->right_baner_block,"Баннер на главной справа");
	$form->addTinymce("<em>Баннер слева</em><br />", "configs[left_block]",$configs->left_block,"Баннер слева");
	//$form->addTinymce("<em>Футер</em><br />", "configs[footer]",$configs->footer,"Футер");
		
	$form->addSubmit("Добавить","Обновить"); 
	$content .= $form->printForm();
	
	$globalTemplateParam -> set('content', $content);
	global $template;
	$template = "admin/edit/simple_edit.tpl";
?>