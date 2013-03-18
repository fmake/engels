<?php

if (!$admin->isLogined())
    die("Доступ запрещен!");

$flag_url = true;

# Поля
$filds = array(
    'title' => 'Название',
);

$globalTemplateParam->set('filds', $filds);

$ignor_delete_security = true;
$globalTemplateParam->set('ignor_delete_security', $ignor_delete_security);

$fmakeSiteModulRelation = new fmakeSiteModule_relation();
$fmakeSiteModuleMultipleCat = new fmakeSiteModule_multiple();
$tags = new fmakeSiteModule_tags();

$absitem = new fmakeManual();
$globalTemplateParam->set('absitem', $absitem);
$absitem->setId($request->id);
$absitem->tree = false;

$id_page_modul = 1238;

$fmakeTypeTable = new fmakeTypeTable();
$absitem_dop = new fmakeTypeTable();
$absitem_dop->table = $fmakeTypeTable->getTable($id_page_modul);
$absitem_dop->setId($request->id);

$manual_categories = $absitem->getCatAsTree($id_page_modul,0,false,false,3);

//printAr($news_categories);

$actions = array('active',
    'edit',
    'delete',
	'comments',
	/*'post_vk'*/);
$globalTemplateParam->set('actions', $actions);


$limit = 30;
$page = ($request->page)? $request->page : 1;

/*фильтры*/
$filters_left = "admin/blocks/filter_manual.tpl";
$globalTemplateParam->set('filters_left', $filters_left);

$globalTemplateParam->set('categories', $manual_categories);

$filters = $_REQUEST['filter'];
$globalTemplateParam->set('filters', $filters);
/*фильтры*/

$button = "<button class=\"fmk-button-admin\" onclick=\"document.location='/admin/?modul={$request->modul}&action=export_csv';return false;\"><div><div><div>Выгрузка в CSV</div></div></div></button>";
$globalTemplateParam->set('button', $button);
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
					
				if($_POST['main'])
					$_POST['main'] = 1;
				else
					$_POST['main'] = 0;
				
				$_POST['file'] = 'item_manual';
				/*-------------------выставление параметров----------------------------*/
				
                foreach ($_POST as $key => $value){
                    //$absitem->addParam($key, mysql_real_escape_string($value));
					$absitem->addParam($key, $value);
				}
				$absitem->addParam("date_create", time());	
                $absitem->newItem();
				
                $fmakeSiteModulRelation->setPageRelation($_POST['parent'], $absitem->id);
                
                $_POST['id'] = $absitem->id;
                foreach ($_POST as $key => $value){
                    //$absitem->addParam($key, mysql_real_escape_string($value));
					$absitem_dop->addParam($key, $value);
				}
							
                $absitem_dop->newItem();
                
				/*множественные категории*/
				$fmakeSiteModuleMultipleCat->addParents($_POST['parents'],$absitem -> id);
				/*множественные категории*/
				
				/*теги*/
				$tags->addTags($_POST['tags'],$absitem -> id) ;
				/*теги*/
                
                if($_FILES['picture']['tmp_name'])
                    $absitem->addFile($_FILES['picture']['tmp_name'], $_FILES['picture']['name']);

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
					
				if($_POST['main'])
					$_POST['main'] = 1;
				else
					$_POST['main'] = 0;
				
				/*-------------------выставление параметров----------------------------*/	
					
                foreach ($_POST as $key => $value){
                    //$absitem->addParam($key, mysql_real_escape_string($value));
					$absitem->addParam($key, $value);
				}
				
				$absitem->update();
				$fmakeSiteModulRelation->setPageRelation($_POST['parent'], $absitem->id);
				
				$info_items_dop = $absitem_dop->getInfo();
        		foreach ($_POST as $key => $value){
                    //$absitem->addParam($key, mysql_real_escape_string($value));
					$absitem_dop->addParam($key, $value);
				}
				
				if($info_items_dop) $absitem_dop->update();
				else $absitem_dop->newItem();
				
				/*множественные категории*/
				$fmakeSiteModuleMultipleCat->addParents($_POST['parents'],$absitem -> id);
				/*множественные категории*/
				
				/*теги*/
				$tags->addTags($_POST['tags'],$absitem -> id) ;
				/*теги*/
				
                if($_FILES['picture']['tmp_name'])
                    $absitem->addFile($_FILES['picture']['tmp_name'], $_FILES['picture']['name']);
                
                break;

            case 'delete': // Удалить
                $absitem->delete();
                $absitem_dop->delete();
                break;
			case 'export_csv':
				$fields = array("id","anons","info","city","addres","addres_coord","phone","email","web","time_work","fio_contakt","phone_contakt");
				$absitem->export_csv("export_manual.csv",$fields,"`manual`");
        }

        //$items = $absitem->getAll();
		$absitem->order = "b.date DESC, a.id";
		$absitem->order_as = "DESC";
		if($filters){
			//echo 'qq';
			$items = $absitem->getByPageAdminFilter($filters,$id_page_modul, $limit, $page,"a.`file` = 'item_manual'");
			$count = $absitem->getByPageCountAdminFilter($filters,$id_page_modul,$id_page_modul,"a.`file` = 'item_manual'");
		}else{
			$items = $absitem->getByPageAdmin($id_page_modul, $limit, $page,"a.`file` = 'item_manual'");
			$count = $absitem->getByPageCountAdmin($id_page_modul,$id_page_modul,"a.`file` = 'item_manual'");
		}
		//printAr($items);
		$pages = ceil($count/$limit);
		
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

		//галлерея
		$fmakeGalleryNotice = new fmakeGallery();
		$fmakeGalleryNotice->table = $fmakeGalleryNotice->table_notice_galley;
		$fmakeGalleryNotice->idField = 'id_site_modul';
		$fmakeGalleryNotice->setId($request->id);
		$do_gallery = $fmakeGalleryNotice->getInfo();
		$fmakeGallery = new fmakeGallery();
		$fmakeGallery->setId($do_gallery['id_gallery']);
		$item_gallery = $fmakeGallery->getInfo();
		//
	
		/*теги*/
		$tagsStr = $tags -> tagsToString( $tags -> getTags ($items[$absitem->idField]) );
		$tagsJsStr = $tags -> tagsToJsString( $tags -> getAll () );
		/*теги*/
	
		$content .= '<script type="text/javascript" src="/js/admin/jquery.autocomplete.js"></script>
					<script type="text/javascript" src="/js/gallery/admin-gallery.js"></script>
					<link rel="stylesheet" type="text/css" href="/js/calendar_to_time/latest.css" />
					<script type="text/javascript" src="/js/calendar_to_time/latest.js"></script>';
	
        $form = new utlFormEngine($modul, "/admin/index.php?modul=" . $request->modul, "POST", "multipart/form-data");

        $form->addHidden("action", (($_GET['action'] == 'new') ? 'insert' : 'update'));
        $form->addHidden("id", $items['id']);

        $form->addVarchar("<b>Название</b>", "caption", $items["caption"]);
		$form->addVarchar("<i>Заголовок</i>", "title", $items["title"]);
		$form->addVarchar("<i>Описание</i>", "description", $items["description"]);
		$form->addVarchar("<em>Ключевые</em>", "keywords", $items["keywords"],50,false,"");
		$form->addVarchar("<i>URL</i>", "redir", $items["redir"]);
        		
		$_select = $form->addSelect("Категория", "parent");
        if ($manual_categories) foreach ($manual_categories as $category) {
            if ($category['id'] != $items['id']) $_select->AddOption(new selectOption($category['id'], blankprint($category['level']).$category['title'], (($category['id'] == $items['parent'])? true : false )));
        }
        $form->AddElement($_select);
		
		/*--------множественный выбор категорий----------*/
		$_select = $form->addSelect("Множественный выбор категорий", "parents[]","multiple='multiple'","multiple_parents");
        //$_select->AddOption(new selectOption("", "", false));
        if ($manual_categories) foreach ($manual_categories as $category) {
            if ($category['id'] != $items['parent']) {
				$_select->AddOption(new selectOption($category['id'], blankprint($category['level']).$category['title'], (($fmakeSiteModuleMultipleCat->isItemParent($category['id'],$items[$absitem->idField]))? true : false )));
			}
        }
        $form->AddElement($_select);
		/*--------множественный выбор категорий----------*/
		
		$form->addHtml('Дата (ДД.ММ.ГГГГ)',"<td>Дата (ДД.ММ.ГГГГ)</td><td><input type=\"text\" class=\"datepickerTimeField\" id=\"filter-date1\" name=\"date\" value=\"".(($items_dop['date'])? $absitem->setDate($items_dop['date'],"d.m.Y H:i:s") : $absitem->setDate(time(),"d.m.Y H:i:s"))."\"  ></td>");
        if($items['picture'])
            $form->addHtml("", "<tr><td colspan='2'><img width='150' src='/{$absitem->fileDirectory}{$items['id']}/{$items['picture']}' /></td></tr>");
        $form->addFile("Фото:", "picture",$text = false);
        
        //$form->addTextArea("Анонс", "anons", $items_dop["anons"], 50, 50);
        
		$form->addCheckBox("Включить/Выключить", "active", 1, ($items["active"]==='0') ? false : true);
		
        //$form->addCheckBox("Главная новость", "main", 1, ($items_dop["main"]==='0') ? false : true);
        
		/*теги*/
		$form->addTextAreaMini("Метки ( через запятую )", "tags", $tagsStr,1,1);
		/*теги*/
		
		/*-----------------галлерея----------------------*/
		if($items){
			if($item_gallery){
				$form->addHtml('','<td colspan="2"><a class="action-link" onclick="return false;" id="link-gallery" href="../../fmake/modules/core/fmakeGallery/index.php?id_gallery='.$item_gallery['id'].'"><div><img alt="" src="/images/admin/and.png"></div>Изменить галерею</a> <div style="padding-top: 6px;">'.$item_gallery[caption].'</div><td>');
			}
			else{
				$form->addHtml('','<td colspan="2"><a class="action-link" onclick="return false;" id="link-gallery" href="../../fmake/modules/core/fmakeGallery/index.php?id_gallery='.$item_gallery['id'].'&id_content='.$items['id'].'"><div><img alt="" src="/images/admin/and.png"></div>Добавить галерею</a> <td>');
			}
		}
		else{
			$form->addHtml('','<td colspan="2">Для добавления галереи сохраните страницу<td>');
		}
		
		$form->addHtml("", '<td colspan="2">
<div id="iframe-pole" style="position: fixed; top:100px; left: 136px;z-index: 9999999;width: 800px; min-height: 500px;display: none;"></div></td>');
		/*-----------------галлерея----------------------*/
		
		$form->addTextArea("Краткое описание", "info", $items_dop["info"], 50, 50);
		
		$form->addVarchar("<i>Город</i>", "city", $items_dop["city"]);
		
		$form->addVarchar("<i>Адрес</i>", "addres", $items_dop["addres"]);
		$form->addHidden("addres_coord", $items_dop["addres_coord"]);
        
		/* ------------------- google map --------------------
		$form->addHtml("Google Карта","<tr><td colspan='2'>
												<div class=\"map-places\" style=\"border: 2px solid #BBBBBB;height: 320px;position: relative;\">
													<div id=\"map-content\">
														<div id=\"map_canvas\" style=\"position:absolute; z-index:1;\"></div>
														<script type=\"text/javascript\">
															initialize();
															(function() {
																makeScrollable('map_canvas', function(delta) {
																  ;
																});
															})();
														</script>
													</div>
												</div>
										</td></tr>");
		------------------- google map -------------------- */
		
		/* ------------------- yandex map --------------------*/
		$form->addHtml("Google Карта","<tr><td colspan='2'>
												<div class=\"map-places\" style=\"border: 2px solid #BBBBBB;height: 320px;position: relative;\">
													<div id=\"map\" style=\"width: 100%; height: 324px;\"></div>
												</div>
										</td></tr>");
		/*------------------- yandex map -------------------- */ 
		
		$form->addVarchar("<i>Телефон</i>", "phone", $items_dop["phone"]);
		$form->addVarchar("<i>Email</i>", "email", $items_dop["email"]);
		$form->addVarchar("<i>Web</i>", "web", $items_dop["web"]);
		$form->addVarchar("<i>Время работы</i>", "time_work", $items_dop["time_work"]);
		$form->addVarchar("<i>ФИО контактного лица</i>", "fio_contakt", $items_dop["fio_contakt"]);
		$form->addVarchar("<i>Телефон контактного лица</i>", "phone_contakt", $items_dop["phone_contakt"]);
		
		
		
        //$form->addTinymce("Текст", "text", $items["text"]);

        $form->addSubmit("save", "Сохранить");
        $content .= $form->printForm();

		/*теги*/
		$content .= '<script type="text/javascript">
			var tags = ['.$tagsJsStr.']
		
			$("#tags").autocomplete(tags , {
				multiple: true,
				mustMatch: false,
				autoFill: true
			});
		</script>';
		/*теги*/
		
		$content .= "
		<script type=\"text/javascript\" >
			{$absitem->getScriptItemAdmin($items['id'])}
			window.onload = function () { 
				ymaps.ready(function () {
					addPlace(array_place);
				})
			}
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
