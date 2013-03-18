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
	
	$_modul = $form->addSelect("Включить/Выключить сайт", "configs[site_on_off]"); 
	$_modul->AddOption(new selectOption('1', "Выключить", (($configs->site_on_off=='1')? true : false )));
	$_modul->AddOption(new selectOption('0', "Включить", (($configs->site_on_off=='0')? true : false )));
	$form->AddElement($_modul);
	
	$form->addSubmit("Добавить","Обновить");
	$content = $form->printForm();
	
	$form = new utlFormEngine($modul, "/admin/index.php?modul=".$request->modul);
	$form->formLegend = "Основные параметры";
	$form->addHidden("action", 'change');
		
	$form->addVarchar("<em><b>Телефон</b></em>", "configs[phone1]",$configs->phone1,50,false,"Используется на основных страницах сайта и в футере");
	$form->addVarchar("<em><b>Телефон 2</b></em>", "configs[phone2]",$configs->phone2,50,false,"Используется на основных страницах сайта и в футере");
	$form->addVarchar("<em><b>Емайл</b></em>", "configs[email]",$configs->email,50,false,"Используется на основных страницах сайта и в футере, а так же для рассылки и оповещения с сайта");
        
        $form->addVarchar("<em><b>Количество новостей</b><em>", "configs[news_count]",$configs->news_count,20,false,"Количество новостей, выводимых на странице");
        
        $form->addVarchar("<em><b>Количество фоторепортажей</b><em>", "configs[reports_count]",$configs->reports_count,20,false,"Количество фоторепортажей, выводимых на странице");
	   

    $form->addVarchar("<em><b>ID раздела Новости от читателей</b><em>", "configs[id_news_chitateli]",$configs->id_news_chitateli,50,false,"");    
    $form->addVarchar("<em><b>ID раздела Обзоры</b><em>", "configs[id_news_obzor]",$configs->id_news_obzor,50,false,"");
    
	$form->addSubmit("Добавить","Обновить");
	$content .= $form->printForm();
	
	$form = new utlFormEngine($modul, "/admin/index.php?modul=".$request->modul);
	$form->formLegend = "Текстовые блоки";
	$form->addHidden("action", 'change');
	$form->addVarchar("<em><b>Анонс на главной текст</b><em>", "configs[anons_main_title]",$configs->anons_main_title,50,false,"");
	$form->addVarchar("<em><b>Анонс на главной ссылка</b><em>", "configs[anons_main_url]",$configs->anons_main_url,50,false,"");
	$form->addSubmit("Добавить","Обновить"); 
	$content .= $form->printForm();
	
	$form = new utlFormEngine($modul, "/admin/index.php?modul=".$request->modul);
	$form->formLegend = "Текстовые блоки";
	$form->addHidden("action", 'change');
	$form->addTinymce("<em>Футер</em><br />", "configs[footer]",$configs->footer,"Футер");
	$form->addTinymce("<em>Блок текстовых объявлений внизу</em><br />", "configs[text_reklama]",$configs->text_reklama,"");
	$form->addSubmit("Добавить","Обновить"); 
	$content .= $form->printForm();
	
	$form = new utlFormEngine($modul, "/admin/index.php?modul=".$request->modul);
	$form->formLegend = "";
	$form->addHtml("Sitemap","<a href=\"http://".$hostname."/sitemap_xml.php?key=1234509876\" target=\"_blank\" style=\"font-size: 15px;\">Сгенерить sitemap.xml</a>");
	$content .= $form->printForm();
	
	$globalTemplateParam -> set('content', $content);
	global $template;
	$template = "admin/edit/simple_edit.tpl";
?>