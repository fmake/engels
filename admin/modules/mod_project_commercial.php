<?php
if (!$admin->isLogined())
	die("Доступ запрещен!");

# Поля
$filds = array(
	'caption'=>'Название',
	'price'=>'Деньги',
	'price_use'=>'Израсходованные',
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

	$fmakeProjectCommercialRelation = new fmakeProjectCommercial_relation();
	$absitem = new fmakeProjectCommercial($request->id);
	
	$fmakeSiteUser = new fmakeSiteUser();
	$users = $fmakeSiteUser->getAll();
	
//printAr($_REQUEST);	
	
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
								
				/*-------------------выставление параметров----------------------------*/
				
				foreach ($_POST as $key=>$value){
					$absitem ->addParam($key, $value );
				}
				$absitem -> newItem();
					
				/*-------------------добавление банеров и привязка к проекту----------------------------*/
				$fmakeBanerContent = new fmakeBanerContent();
				
				$id_page_modul = 5585;
				$fmakeTypeTable = new fmakeTypeTable();
				$fmakeBanerContent_dop = new fmakeTypeTable();
				$fmakeBanerContent_dop->table = $fmakeTypeTable->getTable($id_page_modul);
				$not_delete_array = array();
				if($_POST['baner']['new'])foreach ($_POST['baner']['new']['caption'] as $key=>$value){
					$fmakeBanerContent->addParam("caption", $value);
					$fmakeBanerContent->addParam("title", $value);
					$fmakeBanerContent->addParam("parent", $id_page_modul);
					$fmakeBanerContent->addParam("file", 'item_baner');
					$fmakeBanerContent->addParam("date_create", time());
					$fmakeBanerContent->newItem();
					$id = $fmakeBanerContent->id;
					$fmakeProjectCommercialRelation->addPageRelation($absitem->id,$id);
					$fmakeBanerContent_dop->addParam("id", $id);
					$fmakeBanerContent_dop->addParam("id_type", $_POST['baner']['new']['id_type'][$key]);
					$fmakeBanerContent_dop->addParam("price", $_POST['baner']['new']['price'][$key]);
					$fmakeBanerContent_dop->addParam("url", $_POST['baner']['new']['url'][$key]);
					$fmakeBanerContent_dop->addParam("max_count_view", $_POST['baner']['new']['max_count_view'][$key]);
					
					$fmakeBanerContent_dop->addParam("regular_exp", $_POST['baner']['new']['regular_exp'][$key]);
					$fmakeBanerContent_dop->addParam("price_baner_view", $_POST['baner']['new']['price_baner_view'][$key]);
					$fmakeBanerContent_dop->addParam("price_baner_click", $_POST['baner']['new']['price_baner_click'][$key]);
					
					
					if($value['date_to']) $value['date_to'] = strtotime($value['date_to']);
					else $value['date_to'] = 0;
					if($value['date_from']) $value['date_from'] = strtotime($value['date_from']);
					else $value['date_from'] = 0;
					
					$fmakeBanerContent_dop->addParam("date_to", $value['date_to']);
					$fmakeBanerContent_dop->addParam("date_from", $value['date_from']);
					
					$fmakeBanerContent_dop->newItem();
					if ($_FILES['baner_new_picture']['tmp_name'][$key]) {
						$fmakeBanerContent->addFile($_FILES['baner_new_picture']['tmp_name'][$key], $_FILES['baner_new_picture']['name'][$key]);
					}
				}
				
				/*-------------------добавление банеров и привязка к проекту----------------------------*/
			break;
		
			case 'update': // Переписать
			
				/*-------------------выставление параметров----------------------------*/
				
								
				/*-------------------выставление параметров----------------------------*/
			
				foreach ($_POST as $key=>$value){
					$absitem ->addParam($key, $value );
				}
				$absitem -> update();
				
				/*-------------------добавление банеров и привязка к проекту----------------------------*/
				$fmakeBanerContent = new fmakeBanerContent();
				
				$id_page_modul = 5585;
				$fmakeTypeTable = new fmakeTypeTable();
				$fmakeBanerContent_dop = new fmakeTypeTable();
				$fmakeBanerContent_dop->table = $fmakeTypeTable->getTable($id_page_modul);
				$not_delete_array = array();
				if($_POST['baner']['new'])foreach ($_POST['baner']['new']['caption'] as $key=>$value){
					$fmakeBanerContent->addParam("caption", $value);
					$fmakeBanerContent->addParam("title", $value);
					$fmakeBanerContent->addParam("parent", $id_page_modul);
					$fmakeBanerContent->addParam("file", 'item_baner');
					$fmakeBanerContent->addParam("date_create", time());
					$fmakeBanerContent->newItem();
					$id = $fmakeBanerContent->id;
					$fmakeProjectCommercialRelation->addPageRelation($absitem->id,$id);
					$fmakeBanerContent_dop->addParam("id", $id);
					$fmakeBanerContent_dop->addParam("id_type", $_POST['baner']['new']['id_type'][$key]);
					$fmakeBanerContent_dop->addParam("price", $_POST['baner']['new']['price'][$key]);
					$fmakeBanerContent_dop->addParam("url", $_POST['baner']['new']['url'][$key]);
					$fmakeBanerContent_dop->addParam("max_count_view", $_POST['baner']['new']['max_count_view'][$key]);
					
					$fmakeBanerContent_dop->addParam("regular_exp", $_POST['baner']['new']['regular_exp'][$key]);
					$fmakeBanerContent_dop->addParam("price_baner_view", $_POST['baner']['new']['price_baner_view'][$key]);
					$fmakeBanerContent_dop->addParam("price_baner_click", $_POST['baner']['new']['price_baner_click'][$key]);
					
					$fmakeBanerContent_dop->newItem();
					if ($_FILES['baner_new_picture']['tmp_name'][$key]) {
						$fmakeBanerContent->addFile($_FILES['baner_new_picture']['tmp_name'][$key], $_FILES['baner_new_picture']['name'][$key]);
					}
					$not_delete_array[] = $id;
				}
				unset($_POST['baner']['new']);
				if($_POST['baner'])foreach ($_POST['baner'] as $key=>$value){
					$fmakeBanerContent->setId($key);
					$fmakeBanerContent->addParam("caption", $value['caption']);
					$fmakeBanerContent->addParam("title", $value['caption']);
					$fmakeBanerContent->update();
					$id = $fmakeBanerContent->id;
					//$fmakeProjectCommercialRelation->addPageRelation($absitem->id,$id);
					$fmakeBanerContent_dop->setId($key);
					$fmakeBanerContent_dop->addParam("id", $id);
					$fmakeBanerContent_dop->addParam("id_type", $value['id_type']);
					$fmakeBanerContent_dop->addParam("price", $value['price']);
					$fmakeBanerContent_dop->addParam("url", $value['url']);
					$fmakeBanerContent_dop->addParam("max_count_view", $value['max_count_view']);
					
					$fmakeBanerContent_dop->addParam("regular_exp", $value['regular_exp']);
					$fmakeBanerContent_dop->addParam("price_baner_view", $value['price_baner_view']);
					$fmakeBanerContent_dop->addParam("price_baner_click", $value['price_baner_click']);
					
					if($value['date_to']) $value['date_to'] = strtotime($value['date_to']);
					else $value['date_to'] = 0;
					if($value['date_from']) $value['date_from'] = strtotime($value['date_from']);
					else $value['date_from'] = 0;
					
					$fmakeBanerContent_dop->addParam("date_to", $value['date_to']);
					$fmakeBanerContent_dop->addParam("date_from", $value['date_from']);
					$fmakeBanerContent_dop->update();
					if ($_FILES['baner_picture_'.$key]['tmp_name']) {
						$fmakeBanerContent->addFile($_FILES['baner_picture_'.$key]['tmp_name'], $_FILES['baner_picture_'.$key]['name']);
					}
					$not_delete_array[] = $id;
				}
				$fmakeProjectCommercialRelation->deleteRelation($absitem->id,$not_delete_array);
				/*-------------------добавление банеров и привязка к проекту----------------------------*/
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
			/*---------Банеры привязанные к проекту------------*/
			$fmakeBanerContent = new fmakeBanerContent();
			$id_baners = $fmakeProjectCommercialRelation->getContentId($item['id']);
			if($id_baners) $items_baners = $fmakeBanerContent->getByPageAdmin(5585, false,1,"a.id in ( {$id_baners} ) AND a.`file` = 'item_baner'",true);
			$use_price = 0;
			if($items_baners)foreach($items_baners as $item_price){
				$use_price += $item_price[use_price];
			}
			/*---------Банеры привязанные к проекту------------*/
			$items[$key]['price_use'] = round($use_price,2);
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

		/*---------Банеры привязанные к проекту------------*/
		$fmakeBanerContent = new fmakeBanerContent();
		$id_baners = $fmakeProjectCommercialRelation->getContentId($items['id']);
		if($id_baners) $items_baners = $fmakeBanerContent->getByPageAdmin(5585, false,1,"a.id in ( {$id_baners} ) AND a.`file` = 'item_baner'",true);
		$use_price = 0;
		if($items_baners)foreach($items_baners as $key=>$item){
			$use_price += $item[use_price];
		}
		/*---------Банеры привязанные к проекту------------*/
	
		$content .= '<script type="text/javascript" src="/js/admin/jquery.autocomplete.js"></script>
					<link rel="stylesheet" type="text/css" href="/js/calendar_to_time/latest.css" />
					<script type="text/javascript" src="/js/calendar_to_time/latest.js"></script>';
	
		$form = new utlFormEngine($modul, "/admin/index.php?modul=" . $request->modul, "POST", "multipart/form-data");
		$form->addHidden("action", (($request->action == 'new')?'insert':'update'));
		$form->addHidden("id", $items[$absitem->idField]);
		
		
		$form->addVarchar("Название", "caption", $items['caption']);
		
		$_modul = $form->addSelect("Пользователь", "id_user");
		
		if ($users) foreach ($users as $category) {
			$name = ($category['name'])? $category['name'] : (($category['name_social'])? $category['name_social'] :$category['login']);
			$_modul->AddOption(new selectOption($category['id_user'], $name, (($category['id_user'] == $items['id_user'])? true : false )));
        }
		$form->AddElement($_modul);
		
		$form->addHtml('Израсходованные деньги',"<td>Израсходованные деньги</td><td>".round($use_price,2)."</td>");
		$form->addVarchar("Деньги", "price", intval($items['price']));
		
		/*---------Форма добавления банеров------------*/
		
		if($items_baners)foreach($items_baners as $key=>$item){
			$fmakeBanerContent = new fmakeBanerContent();
			$type_baners = $fmakeBanerContent->type_baners;
			if($type_baners)foreach($type_baners as $key_type=>$item_type){
				$selected = ($key_type == $item['id_type'])? "selected" : "";
				$select_type_options .= '<option value="'.$key_type.'" '.$selected.' >'.$item_type.'</option>';
			}
			
			if($item['date_to']) $item['date_to'] = $fmakeBanerContent->setDate($item['date_to'],"d.m.Y H:i:s");
			else $item['date_to'] = '';
			if($item['date_from']) $item['date_from'] = $fmakeBanerContent->setDate($item['date_from'],"d.m.Y H:i:s");
			else $item['date_from'] = '';
			
			$select_sitepage_options = '
				<option value="">Выберете одну из страниц</option>
				<option value="*">Все</option>
				<option value="/">Главная</option>
				<option value="/novosti/">Новости</option>
				<option value="/mesta/">Места</option>
				<option value="/afisha/">Афиша</option>
				<option value="/intervju/">Гость</option>
				<option value="/objavlenija/">Объявления</option>
				<option value="/spravochnik/">Справочник</option>
			';
			
			$str_add_baner .= "<div class='line_baner_add'><b>Настройка банера</b><br/>Название: <input title=\"Название банера\" type=\"text\" name=\"baner[{$item[id]}][caption]\" value=\"{$item[caption]}\" style=\"width:200px;\"/><br/>Банер: <input title=\"Загрузка банера\" type=\"file\" name=\"baner_picture_{$item[id]}\" /><br/>Тип банера: <select title=\"Тип банера\" name=\"baner[{$item[id]}][id_type]\">".$select_type_options."</select><br/>Ссылка: <input title=\"Ссылка на банер\" type=\"text\" name=\"baner[{$item[id]}][url]\" value=\"{$item[url]}\" style=\"width:150px;\"/><br/>Цена за показ: <input title=\"Цена за показ\" type=\"text\" name=\"baner[{$item[id]}][price_baner_view]\" value=\"{$item[price_baner_view]}\" style=\"width:150px;\"/> Цена за клик: <input title=\"Цена за клик\" type=\"text\" name=\"baner[{$item[id]}][price_baner_click]\" value=\"{$item[price_baner_click]}\" style=\"width:150px;\"/><br/><b>Ограничения</b><br/>Страницы применения: <select title=\"Основные типы страниц\" name=\"baner[{$item[id]}][select_regular_exp]\">".$select_sitepage_options."</select><input type=\"text\" name=\"baner[{$item[id]}][regular_exp]\" value=\"{$item[regular_exp]}\" /><br/>Периуд активности: <input title=\"Дата начала\" type=\"text\" class=\"datepickerTimeField\" id=\"filter-date1\" name=\"baner[{$item[id]}][date_to]\" value=\"{$item[date_to]}\"  /><input title=\"Дата окончания\" type=\"text\" class=\"datepickerTimeField2\" id=\"filter-date2\" name=\"baner[{$item[id]}][date_from]\" value=\"{$item[date_from]}\"  /><br/>Расход: <input title=\"Цена расхода банера\" type=\"text\" name=\"baner[{$item[id]}][price]\" value=\"{$item[price]}\" style=\"width:80px;\"/> Кол-во показов: <input title=\"Кол.во показов банера\" type=\"text\" name=\"baner[{$item[id]}][max_count_view]\" value=\"{$item[max_count_view]}\" style=\"width:80px;\"/><br/><b>Статистика</b><br/><span>Просмотров: {$item[use_view]}&nbsp;&nbsp;</span><br/><span>Кликов: {$item[use_click]}&nbsp;&nbsp;</span><br/><span class='delete_baner' style='color:red;cursor:pointer;'>удалить банер</span></div>";
		}
		
		$form->addHtml('Разделитель',"<td >&nbsp;</td><td >&nbsp;</td>");
		$form->addHtml('Форма добавления банеров',"<td >Банеры</td><td ><img id='add_baner' onclick='xajax_addFormBaner();return false;' style='cursor:pointer;' src='/images/admin/ico_add.png'></td>");
		
		$form->addHtml('Форма добавления банеров',"<td colspan='2' id='add_baner_params'>".$str_add_baner."</td>");
		$form->addHtml('Разделитель',"<td >&nbsp;</td><td >&nbsp;</td>");
		/*---------Форма добавления банеров------------*/
		//$form->addHtml('Дата начала (ДД.ММ.ГГГГ)',"<td>Дата начала </td><td><input type=\"text\" class=\"datepickerTimeField\" id=\"filter-date1\" name=\"date_to\" value=\"".(($items['date_to'])? $absitem->setDate($items['date_to'],"d.m.Y H:i:s") : $absitem->setDate(time(),"d.m.Y H:i:s"))."\"  ></td>");
		//$form->addHtml('Дата завершения (ДД.ММ.ГГГГ)',"<td>Дата завершения </td><td><input type=\"text\" class=\"datepickerTimeField2\" id=\"filter-date2\" name=\"date_from\" value=\"".(($items['date_from'])? $absitem->setDate($items['date_from'],"d.m.Y H:i:s") : $absitem->setDate(time(),"d.m.Y H:i:s"))."\"  ></td>");
		
		$form->addTinymce("Описание", "text", $items["text"]);
		
		$form->addSubmit("save", "Сохранить");
		$content .= $form->printForm();
		
		$content .= "<div id=\"id_new_baner\" style=\"display:none;\"><div class=\"line_baner_add\"><b>Настройка банера</b><br/>Название: <input title=\"Название банера\" type=\"text\" name=\"baner[new][caption][]\" value=\"\" style=\"width:200px;\"/><br/>Банер: <input title=\"Загрузка банера\" type=\"file\" name=\"baner_new_picture[]}\" /><br/>Тип банера: <select title=\"Тип банера\" name=\"baner[new][id_type][]\">".$select_type_options."</select><br/>Ссылка: <input title=\"Ссылка на банер\" type=\"text\" name=\"baner[new][url][]\" value=\"\" style=\"width:150px;\"/><br/>Цена за показ: <input title=\"Цена за показ\" type=\"text\" name=\"baner[new][price_baner_view][]\" value=\"\" style=\"width:150px;\"/> Цена за клик: <input title=\"Цена за клик\" type=\"text\" name=\"baner[new][price_baner_click][]\" value=\"\" style=\"width:150px;\"/><br/><b>Ограничения</b><br/>Страницы применения: <select title=\"Основные типы страниц\" name=\"baner[new][select_regular_exp][]\">".$select_sitepage_options."</select><input type=\"text\" name=\"baner[new][regular_exp][]\" value=\"\" /><br/>Периуд активности: <input title=\"Дата начала\" type=\"text\" class=\"datepickerTimeField\" id=\"filter-date1\" name=\"baner[new][date_to][]\" value=\"\"  /><input title=\"Дата окончания\" type=\"text\" class=\"datepickerTimeField2\" id=\"filter-date2\" name=\"baner[new][date_from][]\" value=\"\"  /><br/>Расход: <input title=\"Цена расхода банера\" type=\"text\" name=\"baner[new][price][]\" value=\"\" style=\"width:80px;\"/> Кол-во показов: <input title=\"Кол.во показов банера\" type=\"text\" name=\"baner[new][max_count_view][]\" value=\"\" style=\"width:80px;\"/><br/><span class=\"delete_baner\" style=\"color:red;cursor:pointer;\">удалить</span></div></div>";
		
		$content .= "
		<script type=\"text/javascript\" >
			$(document).ready(function(){
				
				$('.delete_baner').live('click',function(){
					if(confirm('Вы уверенны?')){
						$(this).parent().remove();
					}
				});
				
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