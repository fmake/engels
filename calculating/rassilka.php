<?php
	$key = "1o0r2i9f3l8a4m7e56";
	$fmakeSiteUser = new fmakeMail();
	$breadcrubs = $modul->getBreadCrumbs($modul->id);
	$globalTemplateParam->set('breadcrubs', $breadcrubs);
	switch($request->action){
		case 'delete':
			$email = $_GET['email'];
			$id = $_GET['id'];
			$c_key = $_GET['key'];
			if($key == $c_key && $fmakeSiteUser->isUserRassilka($email,$id)){
				$item['alt_text'] = "<p>Вы отписались от рассылки новостей</p>";
			}
			//echo('delete');
		break;
		/*case 'add':
			if($user->id){
				$fmakeSiteUser->setId($user->id);
				$fmakeSiteUser->addParam('is_rassilka',1);
				$fmakeSiteUser->update();
				$item['alt_text'] = "<p>Вы Подписались на рассылку новостей</p><p><a href=\"/?modul=system-rassylka&action=delete&email=".$userinfo['email']."&id=".$userinfo['id']."&key=1o0r2i9f3l8a4m7e56\"><button id=\"podpiska_no\"></button></a></p>";
			}
			//echo('add');
		break;*/
	}
	$globalTemplateParam->set('item', $item);
	$modul->template = "rassilka/main.tpl";
	
?>