<?php
$no_right_menu = true;
$globalTemplateParam->set('no_right_menu', $no_right_menu);
$breadcrubs = $modul->getBreadCrumbs($modul->id);

$fmakeSiteFotoDay = new fmakeSiteFotoDay();
