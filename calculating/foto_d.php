<?php
#foto_d.php
#еще нужно аплоад 
#еще нужно выборку и бд
#еще нужно сделать премодерацию в админке

$no_right_menu = true;
$globalTemplateParam->set('no_right_menu', $no_right_menu);
//$breadcrubs = $modul->getBreadCrumbs($modul->id);

//$page = !empty($_GET['page']) ? abs((int)$_GET['page']) : 1;
//$limit = $configs->reports_count ? $configs->reports_count : 11; # еще одна под блок, но она пустая итого 12 в блоке.

#id 
$id = 000; 
#лимит самых самых крутых фоток
$limit_one = 1; 
#страница
$page_one = 1;
# начало дня 
$start = strtotime("this day 0:00:00"); 
# конец дня
$end = strtotime("this day 23:59:59");
# лимит мидл фоток
$limit_midle = 11; 

$fmakeSiteFotoDay = new fmakeSiteFotoDay();
$fmakeSiteFotoDay->order = "b.rating DESC, a.id"; # по ratingu

# массив самых крутых фоток
$top_item_foto = $fmakeSiteFotoDay->getByPageAdmin($id, $limit_one, $page_one,
	"a.`file` = 'item_foto_day' and b.`date` > $start and b.`date` < $end and b.`active` = '1'",true);

# массив всех фоток на этот день
$item_foto_this_day = $fmakeSiteFotoDay->getByPageAdmin($id, false, false, 
	" a.`file` = 'item_foto_day' and b.`date` > $start and b.`date` < $end and b.`active` = '1' ");

#массив фоток с средним рейтингом, типо для меню или еще чего
$item_foto_this_day_middle = $fmakeSiteFotoDay->getByPageAdmin($id, $limit_midle, false, 
	" a.`file` = 'item_foto_day' and b.`date` > $start and b.`date` < $end and b.`active` = '1' and b.`rating` > {$top} and b.`rating` < {$top_down}");