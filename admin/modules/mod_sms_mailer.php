<?php
if (!$admin->isLogined())
	die("Доступ запрещен!");

# Поля
$filds = array(
	'text'=>'Текст',
	'date'=>'Дата добавления',
	'user_link'=>'Пользователь'
);

$globalTemplateParam -> set('filds', $filds);

$actions = array(
	'active',
	'edit',
	'delete'
);

$limit = 20;
$page = ($request->page)? $request->page : 1;

$ignor_delete_security = true;
$globalTemplateParam->set('ignor_delete_security', $ignor_delete_security);

$globalTemplateParam -> set('actions', $actions);

	$absitem = new fmakeSmsMailer($request->id);
	
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
				
				foreach ($_POST as $key=>$value){
					$absitem ->addParam($key, $value );
				}
				$absitem -> newItem();
				
			break;
		
			case 'update': // Переписать
						
				foreach ($_POST as $key=>$value){
					$absitem ->addParam($key, $value );
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
		$items = $absitem->getByPage($limit,$page);
		$count = $absitem->getNumRows();
		$pages = ceil($count/$limit);
		
		
		if($items)foreach($items as $key=>$item){
			$items[$key]["date"] = date('d.m.Y H:i',$item['date_create']);
			/**/
			$fmakeSiteUser = new fmakeSiteUser($item['id_user']);
			$user_info = $fmakeSiteUser->getInfo();
			if ($user_info['post_create']) {
				if ($user_info['name']) {
					$name_user = $user_info['name'];
				} else {
					$name_user = $user_info['login'];
				}
			} else {
				if ($user_info['name']) {
					$name_user = $user_info['name'];
				} else {
					$name_user = $user_info['name_social'];
				}
			}
			/**/
			
			$items[$key]["user_link"] = "<a href='/admin/?modul=adm_users_site&id={$item['id_user']}&action=edit'>{$name_user}</a>";
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
	
		/**/
		$fmakeSiteUser = new fmakeSiteUser($items['id_user']);
		$user_info = $fmakeSiteUser->getInfo();
		if ($user_info['post_create']) {
			if ($user_info['name']) {
				$name_user = $user_info['name'];
			} else {
				$name_user = $user_info['login'];
			}
		} else {
			if ($user_info['name']) {
				$name_user = $user_info['name'];
			} else {
				$name_user = $user_info['name_social'];
			}
		}
		/**/
	
		$form = new utlFormEngine($modul, "/admin/index.php?modul=" . $request->modul, "POST", "multipart/form-data");
		$form->addHidden("action", (($request->action == 'new')?'insert':'update'));
		$form->addHidden("id", $items[$absitem->idField]);
				
		$form->addHtml('Эксперт',"<td>Эксперт : </td><td><a href='/admin/?modul=adm_users_site&id={$items['id_user']}&action=edit'>{$name_user}</a></td>");		
		$form->addTextArea("Текст", "text", $items["text"]);
		$form->addTextArea("Телефоны", "phones", $items["phones"]);
		
		$form->addSubmit("save", "Сохранить");
		$content .= $form->printForm();
				
		$globalTemplateParam -> set('content', $content);
		global $template; 
		$template = "admin/edit/simple_edit.tpl";
	break;
}
?>