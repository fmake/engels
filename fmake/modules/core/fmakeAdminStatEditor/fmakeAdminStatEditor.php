<?php

class fmakeAdminStatEditor extends fmakeSiteModule {

	function getStats() {
		$fmakeNews = new fmakeNews();
		$fmakeSiteAdministrator = new fmakeSiteAdministrator();
		$all_users = $fmakeSiteAdministrator->getAll();
		if($all_users)foreach($all_users as $key=>$item){
			$result[$key]['editor'] = $item['name'];
			$result[$key]['kol_vo_news'] = $fmakeNews->countNewsEditor($item[$fmakeSiteAdministrator->idField]);
		}
		return $result;
	}

}