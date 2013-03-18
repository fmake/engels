<?php
if (!$admin->isLogined())
	die("Доступ запрещен!");

# Поля
$filds = array(
	'name'=>'Имя',
	'login'=>'Логин',
	//'email'=>'email'
);

$globalTemplateParam -> set('filds', $filds);

$actions = array(
	'active',
	'edit',
	//'delete'
);

$limit = 20;
$page = ($request->page)? $request->page : 1;

$ignor_delete_security = true;
$globalTemplateParam->set('ignor_delete_security', $ignor_delete_security);

$globalTemplateParam -> set('actions', $actions);

	$fmakeSiteUserMultiple = new fmakeSiteUser_multiple();

	$absitem = new fmakeSiteUser($request->id);
	
	
$status = array(
	0 => array("type"=>"user","name"=>"Пользователь сайта"),
	1 => array("type"=>"ekspert","name"=>"Эксперт"),
);
# Actions
switch($request->action)
{
	case 'insert':
	case 'update':
	case 'delete':
	case 'active':
	default:
		switch($request->action)
		{
			case 'insert': // Новый
				foreach ($_POST as $key=>$value){
					if(($key == "password" && !$value)) continue;
					else if(($key == "password" && $value)) $value = md5($value);
					$absitem ->addParam($key, $value );
				}
				$absitem -> newItem();
				
				/*множественные категории*/
				$fmakeSiteUserMultiple->addParents($_POST['parents'],$absitem -> id);
				/*множественные категории*/
				
				if ($_FILES['picture']['tmp_name']) {
					$absitem->addFile($_FILES['picture']['tmp_name'], $_FILES['picture']['name']);
				}
			break;
		
			case 'update': // Переписать
				foreach ($_POST as $key=>$value){
					if(($key == "password" && !$value)) continue;
					else if(($key == "password" && $value)) $value = md5($value);
					$absitem ->addParam($key, $value );
				}
				$absitem -> update();
				
				/*множественные категории*/
				$fmakeSiteUserMultiple->addParents($_POST['parents'],$absitem -> id);
				/*множественные категории*/
				
				if ($_FILES['picture']['tmp_name']) {
					$absitem->addFile($_FILES['picture']['tmp_name'], $_FILES['picture']['name']);
				}
			break;
		
			case 'delete': // Удалить
				$absitem -> delete();
			break;
		
			case 'active': // Включить/выключить
				$absitem -> active();
			break;
		}
		$items = $absitem->getByPage($limit,$page);
		$count = $absitem->getNumRows();
		$pages = ceil($count/$limit);
		
		
		if($items)foreach($items as $key=>$item){
			$items[$key]["id"] = $item[$absitem->idField];
		}
		
		//printAr($items);
		$globalTemplateParam -> set('items', $items);
		$globalTemplateParam -> set('page', $page);
		$globalTemplateParam -> set('pages', $pages);
		global $template; 
		$template = $block;
		
	break;

	case 'edit': // Если редактировать то покажем картинку
		$items = $absitem -> getInfo();
		
	case 'new': // Далее форма
		//$rols = $absitem->getRoleObj()->getRols();
		
		/*темы эксперртов*/
		$manual_obj = new fmakeManual();
		//$cat = $manual_obj->getCatForMenu(1238,true);
		$manual_categories = $manual_obj->getCatAsTree(1238,0,true,false,3);
		/*темы эксперртов*/
				
		//printAr($rols);
		$form = new utlFormEngine($modul, "/admin/index.php?modul=" . $request->modul, "POST", "multipart/form-data");
		$form->addHidden("action", (($request->action == 'new')?'insert':'update'));
		$form->addHidden("id", $items[$absitem->idField]);
		
		if($items['picture'])
            $form->addHtml("", "<tr><td colspan='2'><img width='150' src='/{$absitem->fileDirectory}{$items['id_user']}/{$items['picture']}' /></td></tr>");
        $form->addFile("Фото:", "picture",$text = false);
		
		$_modul = $form->addSelect("Статус", "type");
		
		if($status) foreach ($status as $modul)
		{
			$_modul->AddOption(new selectOption($modul['type'], $modul['name'], (($modul['type']==$items['type'])? true : false )));
		}
		$form->AddElement($_modul);
		
		$_modul = $form->addSelect("Тема эксперта", "id_oblast_ekspert");
		
		if ($manual_categories) foreach ($manual_categories as $category) {
			$_modul->AddOption(new selectOption($category['id'], blankprint($category['level']).$category['title'], (($category['id'] == $items['id_oblast_ekspert'])? true : false )));
        }
		$form->AddElement($_modul);
		
		/*--------множественный выбор категорий----------*/
		$_select = $form->addSelect("Дополнительные темы", "parents[]","multiple='multiple'","multiple_parents");
        //$_select->AddOption(new selectOption("", "", false));
        if ($manual_categories) foreach ($manual_categories as $category) {
            if ($category['id'] != $items['parent']) {
				$_select->AddOption(new selectOption($category['id'], blankprint($category['level']).$category['title'], (($fmakeSiteUserMultiple->isItemParent($category['id'],$items[$absitem->idField]))? true : false )));
			}
        }
        $form->AddElement($_select);
		/*--------множественный выбор категорий----------*/
		
		
		foreach ($filds as $key=>$fild)
			$form->addVarchar($fild, $key, $items[$key]);
		
		$form->addVarchar("Должность", "job", $items['job']);
		$form->addVarchar("Основная почта", "main_email", $items['main_email']);
		$form->addVarchar("Пароль", "password", "");
		$form->addSubmit("save", "Сохранить");
		$content .= $form->printForm();
		$globalTemplateParam -> set('content', $content);
		global $template; 
		$template = "admin/edit/simple_edit.tpl";
	break;
}
?>