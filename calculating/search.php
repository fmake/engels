<?php
        $breadcrubs = $modul->getBreadCrumbs($modul->id);
        $search_obj = new fmakeSiteModule();
		$fmakeTag = new fmakeSiteModule_tags();
        $globalTemplateParam->set('search_obj', $search_obj);
        $globalTemplateParam->set('breadcrubs', $breadcrubs);

        $page = !empty($_GET['page']) ? abs((int)$_GET['page']) : 1;
        $limit = $configs->news_count ? $configs->news_count : 10;

		//echo $request->modul;
		$search_obj->setRedir($request->modul);
		$item = $search_obj->getInfo();
		//printAr($item);
				
		//$search_obj->order = "b.date DESC, a.id";
		//echo $request->q;
		$items = $search_obj->getByPageSearch($request->getEscape('q'), $limit, $page,false,true);
		$count = $search_obj->getByPageCountSearch($request->getEscape('q'),false,false,true);
		
		if ($_GET)foreach ($_GET as $k=>$it){
			if($k=='q') $query_str .= "{$k}={$it}";
		}
		$globalTemplateParam->set('query_str', $query_str);
		
		$pages = ceil($count/$limit);
		
		if ($page < 1) {
			$page = 1;
		}
		elseif ($page > $pages) {
			$page = $pages;
		}

		if($items)foreach($items as $key=>$item_new){
			$tags = $fmakeTag->getTags($item_new[$search_obj->idField]);
			$items[$key]['tags'] = $tags;
		}
		
		//$modul->title = $item['title'];
		//$modul->description = $item['description'];
		//$modul->keywords = $item['keywords'];

		$breadcrubs = $modul->getBreadCrumbs($item[$search_obj->idField]);
		$globalTemplateParam->set('breadcrubs', $breadcrubs);
		
		$globalTemplateParam->set('items', $items);
		$globalTemplateParam->set('page', $page);
		$globalTemplateParam->set('pages', $pages);
		$globalTemplateParam->set('item', $item);
		$modul->template = "search/main.tpl";

?>
