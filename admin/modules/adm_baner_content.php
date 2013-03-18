<?php

if (!$admin->isLogined())
    die("Доступ запрещен!");

$flag_url = true;

# Поля
$filds = array(
    'title' => 'Название',
	'type_baner'=>'Тип банера'
);

$globalTemplateParam->set('filds', $filds);


$ignor_delete_security = true;
$globalTemplateParam->set('ignor_delete_security', $ignor_delete_security);

$fmakeSiteModulRelation = new fmakeSiteModule_relation();

$absitem = new fmakeBanerContent();
$type_baners = $absitem->type_baners;
$globalTemplateParam->set('absitem', $absitem);
$absitem->setId($request->id);
$absitem->tree = false;

$id_page_modul = 5585;

$fmakeTypeTable = new fmakeTypeTable();
$absitem_dop = new fmakeTypeTable();
$absitem_dop->table = $fmakeTypeTable->getTable($id_page_modul);
$absitem_dop->setId($request->id);

//$news_categories = $absitem->getCatAsTree($id_page_modul);

//printAr($news_categories);

$actions = array('active',
    'edit',
    'delete',
	//'comments',
	/*'post_vk'*/);
$globalTemplateParam->set('actions', $actions);


$limit = 30;
$page = ($request->page)? $request->page : 1;

$no_button_add = true;
$globalTemplateParam->set('no_button_add', $no_button_add);
/*фильтры*/
/*$filters_left = "admin/blocks/filter_news.tpl";
$globalTemplateParam->set('filters_left', $filters_left);

$globalTemplateParam->set('categories', $news_categories);

$filters = $_REQUEST['filter'];
$globalTemplateParam->set('filters', $filters);*/
/*фильтры*/

# Actions
switch ($request->action) {
    case 'up':
    case 'down':
    case 'insert':
    case 'update':
    case 'delete':
    case 'index':
    case 'inmenu':
    case 'active':
	case 'post_vk':
    default:
        switch ($request->action) {
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
				
				/*-------------------выставление параметров----------------------------*/
				if(!$_POST['title'] && $_POST['caption']) $_POST['title'] = $_POST['caption'];
				if($_POST['title'] && !$_POST['caption']) $_POST['caption'] = $_POST['title'];
				
				if(!$_POST['redir']) $_POST['redir'] = $absitem->transliter($_POST['caption']);
				
				if($_POST['date']) $_POST['date'] = strtotime($_POST['date']);
				else{
					$_POST['date'] = date('d.m.Y',time());
				}
				
				if($_POST['active'])
					$_POST['active'] = 1;
				else
					$_POST['active'] = 0;
					
				$_POST['file'] = 'item_baner';
				/*-------------------выставление параметров----------------------------*/
				
                foreach ($_POST as $key => $value){
                    //$absitem->addParam($key, mysql_real_escape_string($value));
					$absitem->addParam($key, $value);
				}
				$absitem->addParam("date_create", time());	
                $absitem->newItem();
                $fmakeSiteModulRelation->setPageRelation($id_page_modul, $absitem->id);
                
                $_POST['id'] = $absitem->id;
                foreach ($_POST as $key => $value){
                    //$absitem->addParam($key, mysql_real_escape_string($value));
					$absitem_dop->addParam($key, $value);
				}
							
                $absitem_dop->newItem();
                
                if ($_FILES['picture']['tmp_name']) {
					$absitem->addFile($_FILES['picture']['tmp_name'], $_FILES['picture']['name']);
				}
                break;

            case 'update': // Переписать
				/*-------------------выставление параметров----------------------------*/
				if(!$_POST['title'] && $_POST['caption']) $_POST['title'] = $_POST['caption'];
				if($_POST['title'] && !$_POST['caption']) $_POST['caption'] = $_POST['title'];
				
				if(!$_POST['redir']) $_POST['redir'] = $absitem->transliter($_POST['caption']);
				
				if($_POST['date']) $_POST['date'] = strtotime($_POST['date']);
				else{
					$_POST['date'] = date('d.m.Y',time());
				}
				
				if($_POST['active'])
					$_POST['active'] = 1;
				else
					$_POST['active'] = 0;
					
				/*-------------------выставление параметров----------------------------*/	
					
                foreach ($_POST as $key => $value){
                    //$absitem->addParam($key, mysql_real_escape_string($value));
					$absitem->addParam($key, $value);
				}
				
				$absitem->update();
				$fmakeSiteModulRelation->setPageRelation($id_page_modul, $absitem->id);
				
				$info_items_dop = $absitem_dop->getInfo();
        		foreach ($_POST as $key => $value){
                    //$absitem->addParam($key, mysql_real_escape_string($value));
					$absitem_dop->addParam($key, $value);
				}
				
				if($info_items_dop) $absitem_dop->update();
				else $absitem_dop->newItem();
				
				
                if ($_FILES['picture']['tmp_name']) {
					$absitem->addFile($_FILES['picture']['tmp_name'], $_FILES['picture']['name']);
				}
                break;

            case 'delete': // Удалить
                $absitem->delete();
                $absitem_dop->delete();
                break;
        }


		$items = $absitem->getByPageAdmin($id_page_modul, $limit, $page,"a.`file` = 'item_baner'");
		$count = $absitem->getByPageCountAdmin($id_page_modul,$id_page_modul,"a.`file` = 'item_baner'");

		//printAr($items);
		$pages = ceil($count/$limit);
		
		if($items)foreach($items as $key=>$item){
			$items[$key]["type_baner"] = $type_baners[$item['id_type']];
		}
		
        $globalTemplateParam->set('items', $items);
		$globalTemplateParam->set('pages', $pages);
		$globalTemplateParam->set('page', $page);
        global $template;
        $template = $block;
        include('content.php');
        break;
    case 'edit':
        $items = $absitem->getInfo();
		$flag_url = false;
		
		$items_dop = $absitem_dop->getInfo();
    case 'new': // Далее форма

	
		$content .= '<script type="text/javascript" src="/js/admin/jquery.autocomplete.js"></script>
					<link rel="stylesheet" type="text/css" href="/js/calendar_to_time/latest.css" />
					<script type="text/javascript" src="/js/calendar_to_time/latest.js"></script>';
	
        $form = new utlFormEngine($modul, "/admin/index.php?modul=" . $request->modul, "POST", "multipart/form-data");

        $form->addHidden("action", (($_GET['action'] == 'new') ? 'insert' : 'update'));
        $form->addHidden("id", $items['id']);
		$form->addHidden("parent", $id_page_modul);
        $form->addVarchar("<b>Название</b>", "caption", $items["caption"]);
		$form->addVarchar("<i>Заголовок</i>", "title", $items["title"]);
		//$form->addVarchar("<i>URL</i>", "redir", $items["redir"]);
        
		$form->addVarchar("<i>Ссылка на банере</i>", "url", $items_dop["url"]);
		$_modul = $form->addSelect("Тип банера", "id_type");
		
		if($type_baners) foreach ($type_baners as $key=>$modul)
		{
			$_modul->AddOption(new selectOption($key, $modul, (($key==$items_dop['id_type'])? true : false )));
		}
		$form->AddElement($_modul);
		
        /*
		if($items['picture'])
            $form->addHtml("", "<tr><td colspan='2'><img width='150' src='/{$absitem->fileDirectory}{$items['id']}/{$items['picture']}' /></td></tr>");
        $form->addFile("Фото:", "picture",$text = false);
        */
		if ($items['picture']) {
            $baner = $absitem->showBaner('/'.$absitem->fileDirectory.$items['id'].'/'.$items['picture'],$items['format']);
			$form->addHtml("", "<tr><td colspan='2'>{$baner}</td></tr>");
		}	
		$form->addFile("Банер:", "picture",false);
		//$form->addCheckBox("Без вантермарка", "wantermark_false", 1, false);
		
        //$form->addTextArea("Анонс", "anons", $items_dop["anons"], 50, 50);
        
		$form->addCheckBox("Включить/Выключить", "active", 1, ($items["active"]==='0') ? false : true);
				
        $form->addSubmit("save", "Сохранить");
        $content .= $form->printForm();
		
		$content .= "
		<script type=\"text/javascript\" >
			$(document).ready(function(){

				/*$('#filter-date1').DatePicker({
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
				});*/
				
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
				
			});
		</script>		
		";
		
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
