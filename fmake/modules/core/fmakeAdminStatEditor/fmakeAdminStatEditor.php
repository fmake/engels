<?php

class fmakeAdminStatEditor extends fmakeSiteModule {

	function getStats($filters = false) {
		$fmakeNews = new fmakeNews();
		$fmakeSiteAdministrator = new fmakeSiteAdministrator();
		
		if($filters['create_user']){
			$fmakeSiteAdministrator->setId($filters['create_user'])
			$all_users[] = $fmakeSiteAdministrator->getInfo();
		} else {
			$all_users = $fmakeSiteAdministrator->getAll();
		}
		
		if($all_users)foreach($all_users as $key=>$item){
			$result[$key]['editor'] = "{$item['name']} ({$item['login']})";
			$result[$key]['kol_vo_news'] = $fmakeNews->countNewsEditor($item['id']);
			$result[$key]['sr_kol_vo_simvolov_news'] = $fmakeNews->averageNewsSymvolEditor($item['id']);
			$result[$key]['sr_kol_vo_uniq_prosm'] = $fmakeNews->countNewsViewEditor($item['id']);
			$result[$key]['sr_kol_vo_prosm_day_news'] = ($result[$key]['kol_vo_news']) ? round($result[$key]['sr_kol_vo_uniq_prosm']/$result[$key]['kol_vo_news']) : 0;
		}
		return $result;
	}

}