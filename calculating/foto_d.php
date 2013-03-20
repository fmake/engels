<?php
$no_right_menu = true;
$globalTemplateParam->set('no_right_menu', $no_right_menu);
//$breadcrubs = $modul->getBreadCrumbs($modul->id);

//$page = !empty($_GET['page']) ? abs((int)$_GET['page']) : 1;
//$limit = $configs->reports_count ? $configs->reports_count : 11; # еще одна под блок, но она пустая итого 12 в блоке.

$id = 000; #id 
$limit_one = 1; #лимит самых крутых фоток
$page_one = 1; #страница

$fmakeSiteFotoDay = new fmakeSiteFotoDay();
$fmakeSiteFotoDay->order = "b.rating DESC, a.id"; # по rating

$top_item_foto = $fmakeSiteFotoDay->getByPageAdmin($id, $limit_one, $page_one,"a.`file` = 'item_foto_day'",true);