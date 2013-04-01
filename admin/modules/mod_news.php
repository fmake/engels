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

$absitem = new fmakeNews();
$globalTemplateParam->set('absitem', $absitem);
$absitem->setId($request->id);
$absitem->tree = false;

$id_page_modul = 2;

$fmakeTypeTable = new fmakeTypeTable();
$absitem_dop = new fmakeTypeTable();
$absitem_dop->table = $fmakeTypeTable->getTable($id_page_modul);
$absitem_dop->setId($request->id);

#----------------------------мнения
$mneniya = new fmakeMneniya();
$all_m = $mneniya->getAll();
$older = $absitem_dop ->getAll();
//PrintAr($older);

/*if($older)foreach ($older as $key => $value) {
	if ($older[$key]['expert'] != 0 or $older[$key]['text_expert'] != 0 or $older[$key]['active_mnenie'] != 0 or $order[$key]['expert_picture'] != 0 ) {
		$mneniya -> addParam('text_expert', $older[$key]['text_expert']);
		$mneniya -> addParam('expert', $older[$key]['expert']);
		$mneniya -> addParam('active_mnenie', $older[$key]['active_mnenie']);
		$mneniya -> addParam('expert_picture', $older[$key]['expert_picture']);
		$mneniya -> addParam('id_news', $older[$key]['id']);
		$mneniya -> newItem();
	}
}
*/
//$mneniya -> setId($request->id);
#----------------------------мнения 
$news_categories = $absitem->getCatAsTree($id_page_modul,0,true);

//printAr($news_categories);

$actions = array('active',
    'edit',
    'delete',
	'comments',
	/*'post_vk'*/);
$globalTemplateParam->set('actions', $actions);

/**/
//$user = new fmakeSiteUser;
//$user_array = $user->getByType('ekspert');
/**/
$limit = 30;
$page = ($request->page)? $request->page : 1;

/*фильтры*/
$filters_left = "admin/blocks/filter_news.tpl";
$globalTemplateParam->set('filters_left', $filters_left);

$globalTemplateParam->set('categories', $news_categories);

$filters = $_REQUEST['filter'];
$globalTemplateParam->set('filters', $filters);
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
			/*case 'post_vk':
				$curl = new cURL();
				$curl -> init();
				/*-----------------публикация vkontakte.ru--------------------
				$curl -> get($hostname."/vk.php?key=1029384756&id_news=".$request->id); 
				$error_vk_popup = $curl -> data();
				
				if($error_vk_popup){
					$url_error = $hostname."/vk.php?key=1029384756&id_news=".$request->id;
					$globalTemplateParam->set('error_vk_popup_url', $url_error);
				}
				/*-----------------публикация vkontakte.ru--------------------
			break;*/
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
				#мнение
				if ($_POST['active_mnenie'])
					$_POST['active_mnenie'] = 1;
				else
					$_POST['active_mnenie'] = 0;
				#мнение
				if($_POST['main'])
					$_POST['main'] = 1;
				else
					$_POST['main'] = 0;
				
				if($_POST['rss_yandex_news'])
					$_POST['rss_yandex_news'] = 1;
				else
					$_POST['rss_yandex_news'] = 0;
				
				$_POST['file'] = 'item_news';
				/*-------------------выставление параметров----------------------------*/
				
                foreach ($_POST as $key => $value){
                    //$absitem->addParam($key, mysql_real_escape_string($value));
					$absitem->addParam($key, $value);
				}
				$absitem->addParam("date_create", time());	
                $absitem->newItem();
                $fmakeSiteModulRelation->setPageRelation($_POST['parent'], $absitem->id);
                
                $_POST['id'] = $absitem->id;
                //$_POST['expert_picture'] = "0";
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
				//addExpertFile;
				if ($_FILES['expert_picture']['tmp_name']) {
					$name = $absitem->addExpertFile($_FILES['expert_picture']['tmp_name'], $_FILES['expert_picture']['name']);
					$absitem_dop->setId($absitem->id);
					$absitem_dop->addParam('expert_picture', $name);
					//echo $absitem_dop->id;
					$absitem_dop->update();
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
				#мнение
				if ($_POST['active_mnenie'])
					$_POST['active_mnenie'] = 1;
				else
					$_POST['active_mnenie'] = 0;
				#мнение	
				if($_POST['main'])
					$_POST['main'] = 1;
				else
					$_POST['main'] = 0;
				
				if($_POST['rss_yandex_news'])
					$_POST['rss_yandex_news'] = 1;
				else
					$_POST['rss_yandex_news'] = 0;
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
				if ($_FILES['expert_picture']['tmp_name']) {
					$name = $absitem->addExpertFile($_FILES['expert_picture']['tmp_name'], $_FILES['expert_picture']['name']);
					$absitem_dop->addParam('expert_picture', $name);
					$absitem_dop->update();
				}
				if($_POST['exspert']['new'])
					foreach ($_POST['exspert']['new']['expert'] as $key => $value){
						$mneniya->addParam("id_news", $_POST['id']);
						$mneniya->addParam("text_expert", $_POST['exspert']['new']['text_expert'][$key]);
						$mneniya->addParam("active_mnenie", $_POST['exspert']['new']['active_mnenie'][$key]);
						$mneniya->addParam("expert", $_POST['exspert']['new']['expert'][$key]);
						$mneniya->newItem();
					}
				unset($_POST['exspert']['new']);
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
			$items = $absitem->getByPageAdminFilter($filters,$id_page_modul, $limit, $page);
			$count = $absitem->getByPageCountAdminFilter($filters,$id_page_modul,$id_page_modul);
		}else{
			$items = $absitem->getByPageAdmin($id_page_modul, $limit, $page);
			$count = $absitem->getByPageCountAdmin($id_page_modul);
		}
		printAr($items);
		$pages = ceil($count/$limit);

		if($items_['id'])foreach ($all_m as $key => $value) {
    		if ($items_dop['id'] == $all_m[$key]['id_news']){
    			$m_items[$items_dop['id']] =  $value;
    		}
    	}
    	//PrintAr($m_items);


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
		/*теги*/
		$tagsStr = $tags -> tagsToString( $tags -> getTags ($items[$absitem->idField]) );
		$tagsJsStr = $tags -> tagsToJsString( $tags -> getAll () );
		/*теги*/
	
		$content .= '<script type="text/javascript" src="/js/admin/jquery.autocomplete.js"></script>
					<link rel="stylesheet" type="text/css" href="/js/calendar_to_time/latest.css" />
					<script type="text/javascript" src="/js/calendar_to_time/latest.js"></script>';
	
        $form = new utlFormEngine($modul, "/admin/index.php?modul=" . $request->modul, "POST", "multipart/form-data");

        $form->addHidden("action", (($_GET['action'] == 'new') ? 'insert' : 'update'));
        $form->addHidden("id", $items['id']);

        $form->addVarchar("<b>Название</b>", "caption", $items["caption"]);
        $form->addVarchar("<b>Короткое название</b>", "short_name", $items_dop["short_name"]);
		$form->addVarchar("<i>Заголовок</i>", "title", $items["title"]);
		$form->addVarchar("<i>Описание</i>", "description", $items["description"]);
		$form->addVarchar("<em>Ключевые</em>", "keywords", $items["keywords"],50,false,"");
		$form->addVarchar("<i>URL</i>", "redir", $items["redir"]);
        

		
		$form->addHtml('Категория',"<td>Категория</td><td>".$absitem->getHtmlSelectCat($id_page_modul,'parent',$items['parent'])."</td>");

		$form->addHtml('Дата (ДД.ММ.ГГГГ)',"<td>Дата (ДД.ММ.ГГГГ)</td><td><input type=\"text\" class=\"datepickerTimeField\" id=\"filter-date1\" name=\"date\" value=\"".(($items_dop['date'])? $absitem->setDate($items_dop['date'],"d.m.Y H:i:s") : $absitem->setDate(time(),"d.m.Y H:i:s"))."\"  ></td>");
        if($items['picture'])
            $form->addHtml("", "<tr><td colspan='2'><img width='150' src='/{$absitem->fileDirectory}{$items['id']}/{$items['picture']}' /></td></tr>");
        $form->addFile("Фото:", "picture", $text = false);
        $form->addCheckBox("Без вантермарка", "wantermark_false", 1, false);
        # Выбор шаблона	
		$temp = $form->addSelect("Шаблон", "templ");
		$temp -> AddOption(new SelectOption(0, "Новый", $items_dop['templ']));
		$temp -> AddOption(new SelectOption(1, "Старый", $items_dop['templ']));
		$form ->AddElement($temp);
		# Выбор шаблона
        $form->addTextArea("Анонс", "anons", $items_dop["anons"], 50, 50);
        
		$form->addCheckBox("Включить/Выключить", "active", 1, ($items["active"]==='0') ? false : true);
		
        $form->addCheckBox("Главная новость", "main", 1, ($items_dop["main"]==='0') ? false : true);

        $form->addTextArea("Код видео с youtube", "video", $items_dop["video"]);
		
		$form->addCheckBox("Экспорт в Яндекс.Новости", "rss_yandex_news", 1, ($items_dop["rss_yandex_news"]) ? true : false);
        
		/*теги*/
		$form->addTextAreaMini("Метки ( через запятую )", "tags", $tagsStr,1,1);
		/*теги*/
		
		$form->addVarchar("<i>Автор</i>", "autor", $items_dop["autor"]);
		
        $form->addTinymce("Текст", "text", $items["text"]);

        #Эксперт
        $select_sitepage_options = "
        	<option value=\"1\">Активно</option>
        	<option value=\"0\">Не активно</option>
      	";
        if($items_baners)$str_add_mnenie .= "
				<div class='line_baner_add'>
					<b>Настройка мнения</b><br/>
					Актив: <select title=\"Активно?\" name=\"exspert[{$items[id]}][active_mnenie]\">".$select_sitepage_options."</select><br />
					Эксперт: <input title=\"Эксперт\" type=\"text\" name=\"exspert[{$items[id]}][expert]\" value=\"\" style=\"width:200px;\"/><br/>
					Картинка эксперта: <input title=\"Картинка эксперта\" type=\"file\" name=\"exspert_picture_{$items[id]}\" />{$link_view_baner}<br/>
					Мнение: <textarea name=\"exspert[{$items[id]}][text_expert]\"></textarea>
					<span class='delete_baner' style='color:red;cursor:pointer;'>удалить мнение</span>
				</div>";

        $form->addHtml('Разделитель',"<td >&nbsp;</td><td >&nbsp;</td>");
        $form->addHtml('Форма добавления мнения',"<td >Мнения</td><td ><img id='add_baner' onclick='xajax_addForm();return false;' style='cursor:pointer;' src='/images/admin/ico_add.png'></td>");
        $form->addHtml('Форма добавления мнения',"<td colspan='2' id='add_form_mnenye'>".$str_add_mnenie."</td>");
        $form->addHtml('Разделитель',"<td >&nbsp;</td><td >&nbsp;</td>");

        //$form->addHtml("","<td><h1>Мнение эксперта</h1><td>");
        //$form->addCheckBox("Включить мнение", "active_mnenie", 1, ($items_dop["active_mnenie"]) ? true : false);
        //if($items_dop['expert_picture'])
        	//$form->addHtml("", "<tr><td colspan='2'><img width='150' src='/{$absitem->fileDirectory}{$items['id']}/expert/{$items_dop['expert_picture']}' /></td></tr>");
        //$form->addFile("Аватарка: ", "expert_picture", $text=false);
        //$form->addVarchar("<i>Имя эксперта</i>", "expert", $items_dop["expert"]);
        //$form->addTextAreaMini("Комментарий эксперта", "text_expert", $items_dop["text_expert"]);

        #Эксперт внезапно закончился

        /*
        $form->addHtml("","<td><h1>Мнение эксперта</h1><td>");
        #селектор экспертов
		$_user = $form->addSelect("Имя эксперта", "id_expert");
		$_user->AddOption(new selectOption(0, "Нет эксперта"));
			if($user_array) foreach ($user_array as $user_one)
			{
				//if($user_one['id_user'] == $items_dop['id_expert']) continue;
				$_user->AddOption(new selectOption($user_one['id_user'],$user_one['name'], (($user_one['id_user']==$items_dop['id_expert'])? true : false )));
			}
		$form->AddElement($_user);
		$form->addTextAreaMini("Комментарий эксперта", "text_expert", $items_dop["text_expert"]);
		#селектор экспертов
		*/

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
			<div id=\"id_new_form\" style=\"display:none;\">
				<div class=\"line_baner_add\">
					<b>Настройка мнения</b><br/>
					Актив: <select title=\"Активно?\" name=\"exspert[new][active_mnenie][]\">".$select_sitepage_options."</select><br />
					Эксперт: <input title=\"Эксперт\" type=\"text\" name=\"exspert[new][expert][]\" value=\"\" style=\"width:200px;\"/><br/>
					Картинка эксперта: <input title=\"Картинка эксперта\" type=\"file\" name=\"exspert_new_picture[]\" /><br/>
					Мнение: <textarea name=\"exspert[new][text_expert][]\"></textarea>
					<span class='delete_baner' style='color:red;cursor:pointer;'>удалить мнение</span>
				</div>
			</div>
			";
		$content .= "
		<script type=\"text/javascript\" >
			$(document).ready(function(){
				$('.delete_baner').live('click',function(){
					if(confirm('Вы уверенны?')){
						$(this).parent().remove();
					}
				});
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
PrintAr($_POST);
PrintAr($_FILES);
        //PrintAr($m_items);
        //PrintAr($all_m);
?>
