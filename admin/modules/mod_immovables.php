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
$tags = new fmakeSiteModule_tags();

$absitem = new fmakeImmovables();
$globalTemplateParam->set('absitem', $absitem);
$absitem->setId($request->id);
$absitem->tree = false;

$id_page_modul = 1291;

$fmakeTypeTable = new fmakeTypeTable();
$absitem_dop = new fmakeTypeTable();
$absitem_dop->table = $fmakeTypeTable->getTable($id_page_modul);
$absitem_dop->setId($request->id);

$immovables_categories = $absitem->getCatAsTree($id_page_modul,0,false,false,3);

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
//$filters_left = "admin/blocks/filter_manual.tpl";
$globalTemplateParam->set('filters_left', $filters_left);

$globalTemplateParam->set('categories', $immovables_categories);

$filters = $_REQUEST['filter'];
$globalTemplateParam->set('filters', $filters);
/*фильтры*/

$time_end_publick_default = strtotime("+1 months",time());

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
				if($_POST['date_end_publick']) $_POST['date_end_publick'] = strtotime($_POST['date_end_publick']);
				else{
					$_POST['date_end_publick'] = $time_end_publick_default;
				}
				
				
				if($_POST['active'])
					$_POST['active'] = 1;
				else
					$_POST['active'] = 0;
					
				if($_POST['main'])
					$_POST['main'] = 1;
				else
					$_POST['main'] = 0;
				
				$_POST['file'] = 'item_immovables';
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
                
				/*теги*/
				$tags->addTags($_POST['tags'],$absitem -> id) ;
				/*теги*/
                
                if ($_FILES['picture']['tmp_name']) {
					if ($_POST['wantermark_false']) $absitem->addFile($_FILES['picture']['tmp_name'], $_FILES['picture']['name'],false);
					else $absitem->addFile($_FILES['picture']['tmp_name'], $_FILES['picture']['name']);
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
				if($_POST['date_end_publick']) $_POST['date_end_publick'] = strtotime($_POST['date_end_publick']);
				else{
					$_POST['date_end_publick'] = $time_end_publick_default;
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
				
				/*теги*/
				$tags->addTags($_POST['tags'],$absitem -> id) ;
				/*теги*/
				
                if ($_FILES['picture']['tmp_name']) {
					if ($_POST['wantermark_false']) $absitem->addFile($_FILES['picture']['tmp_name'], $_FILES['picture']['name'],false);
					else $absitem->addFile($_FILES['picture']['tmp_name'], $_FILES['picture']['name']);
				}
                break;

            case 'delete': // Удалить
                $absitem->delete();
                $absitem_dop->delete();
                break;
        }

        //$items = $absitem->getAll();
		$absitem->order = "b.date DESC, a.id";
		$absitem->order_as = "DESC";
		if($filters){
			//echo 'qq';
			$items = $absitem->getByPageAdminFilter($filters,$id_page_modul, $limit, $page,"a.`file` = 'item_immovables'");
			$count = $absitem->getByPageCountAdminFilter($filters,$id_page_modul,$id_page_modul,"a.`file` = 'item_immovables'");
		}else{
			$items = $absitem->getByPageAdmin($id_page_modul, $limit, $page,"a.`file` = 'item_immovables'");
			$count = $absitem->getByPageCountAdmin($id_page_modul,$id_page_modul,"a.`file` = 'item_immovables'");
		}
		//printAr($items);
		$pages = ceil($count/$limit);
		
		//printAr($items);
		
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
        if($immovables_categories)foreach($immovables_categories as $category){
            if($category['id'] != $items['id']) $_select->AddOption(new selectOption($category['id'], blankprint($category['level']).$category['title'], (($category['id'] == $items['parent'])? true : false )));
        }
        $form->AddElement($_select);
		
		$form->addHtml('Дата (ДД.ММ.ГГГГ)',"<td>Дата (ДД.ММ.ГГГГ)</td><td><input type=\"text\" class=\"datepickerTimeField\" id=\"filter-date1\" name=\"date\" value=\"".(($items_dop['date'])? $absitem->setDate($items_dop['date'],"d.m.Y H:i:s") : $absitem->setDate(time(),"d.m.Y H:i:s"))."\"  ></td>");
		
        if($items['picture'])
            $form->addHtml("", "<tr><td colspan='2'><img width='150' src='/{$absitem->fileDirectory}{$items['id']}/{$items['picture']}' /></td></tr>");
        $form->addFile("Фото:", "picture",$text = false);
        $form->addCheckBox("Без вантермарка", "wantermark_false", 1, false);
		
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
		
		$form->addHtml('Дата окончания публикации (ДД.ММ.ГГГГ)',"<td>Дата окончания публикации (ДД.ММ.ГГГГ)</td><td><input type=\"text\" class=\"datepickerTimeField\" id=\"filter-date1\" name=\"date_end_publick\" value=\"".(($items_dop['date_end_publick'])? $absitem->setDate($items_dop['date_end_publick'],"d.m.Y H:i:s") : $absitem->setDate($time_end_publick_default,"d.m.Y H:i:s"))."\"  ></td>");
		
		$fmakeImmovablesType = new fmakeImmovables();
		$fmakeImmovablesType->table = $fmakeImmovablesType->table_type;
		$immovablesTypes = $fmakeImmovablesType->getAll(true);
		
		$_select = $form->addSelect("Тип недвижимости", "type");
        if($immovablesTypes)foreach($immovablesTypes as $type){
			$_select->AddOption(new selectOption($type['name'],$type['name'], (($type['name'] == $items_dop['type'])? true : false )));
        }
        $form->AddElement($_select);
		
		$form->addVarchar("Кол-во комнат", "count_room", $items_dop["count_room"]);
		$form->addVarchar("Этаж", "floor", $items_dop["floor"]);
		$form->addVarchar("Этажность дома", "floors_home", $items_dop["floors_home"]);
		$form->addVarchar("Общая площадь", "general_area", $items_dop["general_area"]);
		$form->addVarchar("Жилая площадь", "living_area", $items_dop["living_area"]);
		$form->addVarchar("Сан. узел", "wc", $items_dop["wc"]);
		$form->addVarchar("Состояние", "state", $items_dop["state"]);
		$form->addVarchar("Район", "region", $items_dop["region"]);
		$form->addVarchar("Цена за м2", "price_m2", $items_dop["price_m2"]);
		$form->addVarchar("Цена", "price", $items_dop["price"]);
		$form->addVarchar("Адрес", "addres", $items_dop["addres"]);
		$form->addVarchar("Телефон", "phone", $items_dop["phone"]);
		$form->addVarchar("Email", "email", $items_dop["email"]);
		$form->addVarchar("Контактное лицо", "name_user", $items_dop["name_user"]);
		$form->addTextArea("Описание", "info", $items_dop["info"], 50, 50);
		
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
