<?php

if (!$admin->isLogined())
    die("Доступ запрещен!");

$flag_url = true;

# Поля
$filds = array(
    'editor' => 'Редактор',
	'kol_vo_news' => 'кол-во новостей',
	'sr_kol_vo_simvolov_day' => 'ср. кол-во символов за день',
	'sr_kol_vo_uniq_prosm' => 'кол-во уникальных просмотров',
	'sr_kol_vo_prosm_day_news' => 'ср. кол-во просмотров за день/новость',
);

$globalTemplateParam->set('filds', $filds);

$ignor_delete_security = true;
$globalTemplateParam->set('ignor_delete_security', $ignor_delete_security);

$absitem = new fmakeAdminStatEditor();
$globalTemplateParam->set('absitem', $absitem);
$absitem->tree = false;

$meets_categories = $absitem->getChilds($id_page_modul);
//printAr($news_categories);

$actions = array();
$globalTemplateParam->set('actions', $actions);

/*список администраторов сайта*/
$fmakeSiteAdministrator = new fmakeSiteAdministrator();
$all_users = $fmakeSiteAdministrator->getAll();
$globalTemplateParam->set('all_users', $all_users);
/*список администраторов сайта*/

/*фильтры*/
$filters_left = "admin/blocks/filter_stat_editors.tpl";
$globalTemplateParam->set('filters_left', $filters_left);

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
    default:
        
		if($filters){
			//$items = $absitem->getByPageAdminFilter($filters,$id_page_modul, $limit, $page,"a.`file` = 'item_meets'");
			//$count = $absitem->getByPageCountAdminFilter($filters,$id_page_modul,$id_page_modul,"a.`file` = 'item_meets'");
		}else{
			$items = $absitem->getStats();
			//$count = $absitem->getByPageCountAdmin($id_page_modul,$id_page_modul,"a.`file` = 'item_meets'");
		}
		
        $globalTemplateParam->set('items', $items);
        global $template;
        $template = $block;
        include('content.php');
        break;
}
?>
