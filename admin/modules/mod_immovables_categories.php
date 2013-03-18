<?php

if (!$admin->isLogined())
	die("Доступ запрещен!");

$flag_url = true;

# Поля
$filds = array(
	 'title'=>'Название',
	 
);

$globalTemplateParam->set('filds', $filds);

$ignor_delete_security = true;
$globalTemplateParam->set('ignor_delete_security', $ignor_delete_security);

	$fmakeSiteModulRelation = new fmakeSiteModule_relation();

	$absitem = new fmakeImmovables();
	$absitem->setId($request->id);
	$absitem->tree = false;
	$parent = 1291;
	$actions = array(
	'inmenu',
	'active',
	'edit',
	'delete',
	'move');
	$globalTemplateParam->set('actions', $actions);
	
	$manual_categories = $absitem->getCatAsTree($parent,0,false,false,3);

# Actions
switch($request->action)
{
	case 'up':
	case 'down':
	case 'insert':
	case 'update':
	case 'delete':
	case 'index':
	case 'inmenu':
	case 'active':
	default:
		switch($request->action)
		{
			case 'index':
				$absitem->setIndex();
			break;

			case 'inmenu':
			case 'active':
				$absitem->setEnum($request->action);
			break;

			case 'up': // Вверх 
				$absitem->getUp();
			break;

			case 'down': // Вниз
				$absitem->getDown();
			break;

			case 'insert': // Новый
				
				if(!$_POST['title'] && $_POST['caption']) $_POST['title'] = $_POST['caption'];
				if($_POST['title'] && !$_POST['caption']) $_POST['caption'] = $_POST['title'];
				
				if(!$_POST['redir']) $_POST['redir'] = $absitem->transliter($_POST['caption']);
				
				if(!$_POST['parent']) $_POST['parent'] = $parent;
				$_POST['file'] = 'cat_immovables';
				
				foreach ($_POST as $key => $value){
					//$absitem->addParam($key, mysql_real_escape_string($value));
					$absitem->addParam($key, $value);
				}
				$absitem -> newItem();
				$fmakeSiteModulRelation->setPageRelation($_POST['parent'], $absitem->id);
				
			break;
		
			case 'update': // Переписать
				
				if(!$_POST['title'] && $_POST['caption']) $_POST['title'] = $_POST['caption'];
				if($_POST['title'] && !$_POST['caption']) $_POST['caption'] = $_POST['title'];
				
				if(!$_POST['redir']) $_POST['redir'] = $absitem->transliter($_POST['caption']);
				
				if(!$_POST['parent']) $_POST['parent'] = $parent;
				
				foreach ($_POST as $key => $value){
                    //$absitem->addParam($key, mysql_real_escape_string($value));
					$absitem->addParam($key, $value);
				}
				$absitem -> update();
				$fmakeSiteModulRelation->setPageRelation($_POST['parent'], $absitem->id);
			break;
		
			case 'delete': // Удалить
				$absitem -> delete();
			break;
			
		}

		//$absitem->array_cat = false;
		$absitem = new fmakeImmovables();
		$items = $absitem -> getCatAsTree($parent);
		//$items = $manual_categories;
		//printAr($items);
		
		
		$globalTemplateParam->set('items', $items);
		global $template; 
		$template = $block;
		include('content.php');
	break;
	case 'edit':
		$items = $absitem -> getInfo();
		$flag_url = false;
	case 'new': // Далее форма
		$fmakeManual = new fmakeManual();
		$manual_categories = $fmakeManual->getCatAsTree($parent,0,false,false,2);
		
		$content .= '<script type="text/javascript" src="/js/admin/jquery.autocomplete.js"></script>';
		
		$form = new utlFormEngine($modul, "/admin/index.php?modul=".$request->modul);
	
		$form->addHidden("action", (($_GET['action'] == 'new')?'insert':'update'));
		$form->addHidden("id", $items['id']);
		
		$form->addVarchar("<b>Название</b>", "caption", $items["caption"]);
		$form->addVarchar("<i>Заголовок</i>", "title", $items["title"]);
		$form->addVarchar("<i>Описание</i>", "description", $items["description"]);
		$form->addVarchar("<em>Ключевые</em>", "keywords", $items["keywords"],50,false,"");
		$form->addVarchar("<i>URL</i>", "redir", $items["redir"]);
		
		/*$_select = $form->addSelect("Категория", "parent");
        $_select->AddOption(new selectOption(0, "нет категории", false));
        if($manual_categories)foreach($manual_categories as $category){
            if($category['id'] != $items['id']) $_select->AddOption(new selectOption($category['id'], blankprint($category['level']).$category['title'], (($category['id'] == $items['parent'])? true : false )));
        }
        $form->AddElement($_select);*/
		
		$form->addCheckBox("Отобразить в меню", "in_menu", $items["inmenu"], true);
		$form->addHidden("inmenu", $items["inmenu"]);
		$form->addTinymce("Текст", "text", $items["text"]);
		$form->addSubmit("save", "Сохранить");
		$content .= $form->printForm();
		
		if($flag_url){
		$content .='
			<script>
				$("#caption").keyup(function(){
					convert2EN("caption","redir");
				});
			</script>
		';
		}
		
		$globalTemplateParam->set('content', $content);
		$block = "admin/edit/simple_edit.tpl";
		global $template; 
		$template = $block;
	break;
}
?>