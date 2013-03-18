<?php

//ini_set("max_execution_time", "999999");

if (!$admin->isLogined())
	die("Доступ запрещен!");
	
$ignor_delete_security = true;
$globalTemplateParam->set('ignor_delete_security', $ignor_delete_security);

$flag_url = true;

# Поля
$filds = array(
	 'caption'=>'Название',
	 'link'=>'Скачивание',
);

$globalTemplateParam->set('filds', $filds);



$absitem = new fmakeBackup_control();
$fmakeBackup = new fmakeBackup();
	
	$actions = array(/*'move', 'inmenu', 'active', 'edit',*/ 'delete');
	$globalTemplateParam->set('actions', $actions);
	$add_hidden = true;
	$globalTemplateParam->set('add_hidden', $add_hidden);
	$add_button = '<a target="_blank" href="/script_backup_db.php?key=1029384756&action=new"><button class="fmk-button-admin" ><div><div><div>Создать</div></div></div></button></a>';
	$globalTemplateParam->set('add_button', $add_button);


$absitem->setId($request->id);
$absitem->tree = false;
$limit = 20;
$page = ($request->page)? $request->page : 1;



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
				
			break;
		
			case 'update': // Переписать
				
			break;
		
			case 'delete': // Удалить
				$absitem -> delete();
			break;
			
		}

		$items = $absitem -> getByPage($limit, $page);
		$count = $absitem -> getNumRows();
		$pages = ceil($count/$limit);
		
		if($items)foreach($items as $key=>$item){
			if ($absitem->isIntegrityBackupId($item['id'])) {
				$link = "/script_backup_db.php?key=1029384756&action=idbackup&id={$item['id']}";
				$items[$key]['link'] = "<a href='{$link}' target='_blank' style='color:red;'>доделать</a>";
			} else {
				$link = $fmakeBackup->fileDirectory.$item[caption];
				$items[$key]['link'] = "<a href='{$link}' target='_blank'>скачать</a>";
			}
		}
		
		$globalTemplateParam->set('items', $items);
		$globalTemplateParam->set('page', $page);
		$globalTemplateParam->set('pages', $pages);
		global $template; 
		$template = $block;
		include('content.php');
	break;
	case 'edit':
		$items = $absitem -> getInfo();
		$flag_url = false;
		if($items[iscatalog]){
			$catalog = 'Каталог: <a href="/images/catalog/'.$items[id].'/catalog.pdf" target="_blank">каталог</a>';
		}
		$content.='<img src="/images/catalog/'.$items[id].'/mini'.$items[image].'"><br/>'.$catalog;
	case 'new': // Далее форма

		$content .= '<link rel="stylesheet" type="text/css" href="/styles/admin/datepicker.css" />
					<script type="text/javascript" src="/js/datepicker.js"></script>';
	
		
		$form = new utlFormEngine($modul, "/admin/index.php?modul=".$request->modul, "POST", "multipart/form-data");
	
		$form->addHidden("action", (($_GET['action'] == 'new')?'insert':'update'));
		$form->addHidden("id", $items['id']);
		
		
		$form->addVarchar("<em>Название</em>", "caption", $items["caption"]);
		$form->addVarchar("<em>Ссылка</em>", "link_pdf", $items["link_pdf"]);
		$form->addHtml('<b></b>',"<td colspan=\"2\">(Ссылка вида (http://ru.oriflame.com/catalog-images/brochure/ru_RU/201201/CA0E94EFE1A0CE3722503677F53B28E25006EB1C/201201_ru_RU.pdf))</td>");
		$form->addVarchar("<em>Колличество страниц в каталоге</em>", "count_page", $items["count_page"]);

		//$form->addFCKEditor("Анотация", "anotaciya", $items['anotaciya']);
		$form->addFile("Картинка","image");
		//$form->addFile("Загрузить каталог (*.pdf)","catalog");
		
		
		if($items['date']!=0) $tmp_date = date("d.m.Y",$items['date']);
		$form->addHtml('<b>Дата</b>',"<td><b>Дата</b></td><td><input type=\"text\" id=\"filter-date1\" name=\"date\" value=\"".$tmp_date."\"  > <img src=\"/images/vcard_delete.png\" onclick=\"$('#filter-date1').val('');\"  /></td>");
		
		$form->addSubmit("save", "Сохранить");
		$content .= $form->printForm();
		
		$content .= "
		<script type=\"text/javascript\" >
			$(document).ready(function(){


			$('#filter-date1').DatePicker({
				format:'d.m.Y',
				date: '',
				current: '',
				starts: 1,
				onShow:function() {
					return false;
				},
				onChange:function(dateText) {
				   document.getElementById('filter-date1').value = dateText;
				   $('#filter-date1').DatePickerHide();
				}
				});
				
			});
		</script>		
		";
		
		$globalTemplateParam->set('content', $content);
		$block = "admin/edit/simple_edit.tpl";
		global $template; 
		$template = $block;
	break;
}
?>