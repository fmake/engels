<?php
if (!$admin->isLogined())
	die("Доступ запрещен!");

# Поля
$filds = array(
	'caption'=>'Название',
	'type_baner'=>'Тип банера'
);

$globalTemplateParam -> set('filds', $filds);

$type_baners = array(
	"0"=>"Банер главная (721x85)",
	"1"=>"Банер главная (349x117)",
	"2"=>"Банер главная (987x135)",
	"3"=>"Банер главная (201x175)",
	"4"=>"Банер главная (489x191)",
	"5"=>"Банер новости1 (221x-)",
	"6"=>"Банер новости2 (221x-)",
	"7"=>"Банер места1 (221x-)",
	"8"=>"Банер места2 (221x-)",
	"9"=>"Банер афиша1 (221x-)",
	"10"=>"Банер афиша2 (221x-)",
	"11"=>"Банер интервью (221x-)",
	"12"=>"Банер объявления1 (221x-)",
	"13"=>"Банер объявления2 (221x-)",
	"14"=>"Банер недвижимость1 (221x-)",
	"15"=>"Банер недвижимость2 (221x-)",
	"16"=>"Банер главная (233x169) левый",
	"17"=>"Банер главная (233x169) правый"
);

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

	$absitem = new fmakeBaner($request->id);
	
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
				/*-------------------выставление параметров----------------------------*/
				
				$_POST['date_create'] = time();
				
				if($_POST['date_to']) $_POST['date_to'] = strtotime($_POST['date_to']);
				else{
					$_POST['date_to'] = date('d.m.Y',time());
				}
				if($_POST['date_from']) $_POST['date_from'] = strtotime($_POST['date_from']);
				else{
					$_POST['date_from'] = date('d.m.Y',time());
				}
				
				/*-------------------выставление параметров----------------------------*/
				
				foreach ($_POST as $key=>$value){
					$absitem ->addParam($key, $value );
				}
				$absitem -> newItem();
				
				if($_FILES['picture']['tmp_name'])
                    $absitem->addFile($_FILES['picture']['tmp_name'], $_FILES['picture']['name']);
					
			break;
		
			case 'update': // Переписать
			
				/*-------------------выставление параметров----------------------------*/
				
				
				
				if($_POST['date_to']) $_POST['date_to'] = strtotime($_POST['date_to']);
				else{
					$_POST['date_to'] = date('d.m.Y',time());
				}
				if($_POST['date_from']) $_POST['date_from'] = strtotime($_POST['date_from']);
				else{
					$_POST['date_from'] = date('d.m.Y',time());
				}
				
				/*-------------------выставление параметров----------------------------*/
			
				foreach ($_POST as $key=>$value){
					$absitem ->addParam($key, $value );
				}
				$absitem -> update();
				
				if($_FILES['picture']['tmp_name'])
                    $absitem->addFile($_FILES['picture']['tmp_name'], $_FILES['picture']['name']);
					
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
			$items[$key]["type_baner"] = $type_baners[$item['id_type']];
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

		$content .= '<script type="text/javascript" src="/js/admin/jquery.autocomplete.js"></script>
					<link rel="stylesheet" type="text/css" href="/js/calendar_to_time/latest.css" />
					<script type="text/javascript" src="/js/calendar_to_time/latest.js"></script>';
	
		$form = new utlFormEngine($modul, "/admin/index.php?modul=" . $request->modul, "POST", "multipart/form-data");
		$form->addHidden("action", (($request->action == 'new')?'insert':'update'));
		$form->addHidden("id", $items[$absitem->idField]);
		
		$_modul = $form->addSelect("Тип банера", "id_type");
		
		if($type_baners) foreach ($type_baners as $key=>$modul)
		{
			$_modul->AddOption(new selectOption($key, $modul, (($key==$items['id_type'])? true : false )));
		}
		$form->AddElement($_modul);

		$form->addVarchar("Название", "caption", $items['caption']);
		
		$form->addVarchar("Ссылка", "url", $items['url']);
		
		$form->addHtml('Дата начала (ДД.ММ.ГГГГ)',"<td>Дата начала </td><td><input type=\"text\" class=\"datepickerTimeField\" id=\"filter-date1\" name=\"date_to\" value=\"".(($items['date_to'])? $absitem->setDate($items['date_to'],"d.m.Y H:i:s") : $absitem->setDate(time(),"d.m.Y H:i:s"))."\"  ></td>");
		$form->addHtml('Дата завершения (ДД.ММ.ГГГГ)',"<td>Дата завершения </td><td><input type=\"text\" class=\"datepickerTimeField2\" id=\"filter-date2\" name=\"date_from\" value=\"".(($items['date_from'])? $absitem->setDate($items['date_from'],"d.m.Y H:i:s") : $absitem->setDate(time(),"d.m.Y H:i:s"))."\"  ></td>");
		
		if ($items['picture']) {
            $baner = $absitem->showBaner('/'.$absitem->fileDirectory.$items['id'].'/'.$items['picture'],$items['format']);
			$form->addHtml("", "<tr><td colspan='2'>{$baner}</td></tr>");
		}	
		$form->addFile("Банер:", "picture",false);
		//$form->addTinymce("Текст", "text", $items["text"]);
		
		$form->addSubmit("save", "Сохранить");
		$content .= $form->printForm();
		
		$content .= "
		<script type=\"text/javascript\" >
			$(document).ready(function(){
				
				$('.datepickerTimeField').datepicker({
					changeMonth: true,
					changeYear: true,
					dateFormat: 'dd.mm.yy',
					firstDay: 1, changeFirstDay: false,
					navigationAsDateFormat: false,
					duration: 0,// отключаем эффект появления
					onSelect: function() {
						datepickerYaproSetTime();
					}
			
				}).click(function(){// при открытии календаря
					$('.datepickerYaproSelected').removeClass('datepickerYaproSelected');// удаляем со всех элементов класс идентификации
					$(this).addClass('datepickerYaproSelected');// добавляем класс для возможности идентификации выбранного INPUT
					datepickerYaproSetClockSelect();// выставляем значения элементам SELECT
				});
				
				$('.datepickerTimeField2').datepicker({
					changeMonth: true,
					changeYear: true,
					dateFormat: 'dd.mm.yy',
					firstDay: 1, changeFirstDay: false,
					navigationAsDateFormat: false,
					duration: 0,// отключаем эффект появления
					onSelect: function() {
						datepickerYaproSetTime();
					}
			
				}).click(function(){// при открытии календаря
					$('.datepickerYaproSelected').removeClass('datepickerYaproSelected');// удаляем со всех элементов класс идентификации
					$(this).addClass('datepickerYaproSelected');// добавляем класс для возможности идентификации выбранного INPUT
					datepickerYaproSetClockSelect();// выставляем значения элементам SELECT
				});
				
			});
		</script>		
		";
		
		$globalTemplateParam -> set('content', $content);
		global $template; 
		$template = "admin/edit/simple_edit.tpl";
	break;
}
?>