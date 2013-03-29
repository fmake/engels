<?php
if (!$admin->isLogined())
	die("Доступ запрещен!");

# Поля
$filds = array(
	'mail'=>'mail'
);

$globalTemplateParam -> set('filds', $filds);

$actions = array(
	'active',
	'edit',
	'delete'
);

$globalTemplateParam -> set('actions', $actions);
$absitem = new fmakeMail($request->id); 
	
$ignor_delete_security = true;
$globalTemplateParam->set('ignor_delete_security', $ignor_delete_security);
	
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
					$absitem ->addParam($key, (($key=='date_creation')? strtotime($value):$value));
				}
				$absitem -> newItem();
			break;
		
			case 'update': // Переписать
				foreach ($_POST as $key=>$value){
					$absitem ->addParam($key, (($key=='date_creation')? strtotime($value):$value));
				}
				$absitem -> update();
			break;
		
			case 'delete': // Удалить
				$absitem -> delete();
			break;
		
			case 'active': // Включить/выключить
				$absitem -> active();
			break;
		}
		
		
		$items = $absitem->getAll();
		
		foreach($items as $key=>$item){
			$items[$key]['date_creation'] = date('H:i d.m.Y',$item['date_creation']);
		}
		
		$globalTemplateParam -> set('items', $items);
		global $template; 
		$template = $block;
	break;

	case 'edit': // Если редактировать то покажем картинку
		$items = $absitem -> getInfo();
		
	case 'new': // Далее форма
		
		$form = new utlFormEngine($modul, "/admin/index.php?modul=".$request->modul);
		$form->addHidden("action", (($request->action == 'new')?'insert':'update'));
		$form->addHidden("id", $items['id']);
		$form->addVarchar("<b>Email</b>", "mail", $items["mail"]);
		$form->addSubmit("save", "Сохранить");
		$content .= $form->printForm();
		$globalTemplateParam -> set('content', $content);
		global $template; 
		$template = "admin/edit/simple_edit.tpl";
	break;
}
?>