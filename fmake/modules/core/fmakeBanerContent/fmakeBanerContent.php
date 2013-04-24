<?php

class fmakeBanerContent extends fmakeSiteModule {

	//public $fileDirectory = "images/baner/";
	public $type_baners = array(
		"1"=>"B_top_1",
		"2"=>"B_main_2",
		"3"=>"B_center_3",
		"4"=>"B_center_4",
		"5"=>"B_main_5",
		"6"=>"B_main_6",
		"7"=>"B_right_7",
		"8"=>"B_right_8",
		"9"=>"B_right_9",
		"10"=>"B_center_10"
	);
	
	
	function setDate($date,$format = "d.m.Y"){
		return date($format,$date);
	}
	
	/**
	 * 
	 * добавление файла
	 * @param string $tempName
	 * @param string $name
	 */
	function addFile($tempName, $name) {
		$dirs = explode("/", $this->fileDirectory . '/' . $this->id);
		$dirname = ROOT . "/";

		foreach ($dirs as $dir) {
			$dirname = $dirname . $dir . "/";
			if (!is_dir($dirname))
				mkdir($dirname);
		}

		//$wantermark = ROOT.'/images/wantermark2.png';
		
		//$images = new imageMaker($name);
		//$images->imagesData = $tempName;
		//$images->resize(false,false, false, $dirname, '', false);
		copy($tempName, $dirname.$name);
		
		$format = substr($name,1+strrpos($name,"."));
		
		$this->addParam('format', $format);
		$this->addParam('picture', $name);
		$this->update();
	}
	
	function getBanersShow($active = false){
		$select = $this->dataBase->SelectFromDB( __LINE__);
		
		if ($active)
			$select->addWhere("a.active='1'");
		$time = time(); 
		$table = "(select c.*,t.`picture`,t.`date_create`,t.`active` FROM  `baner_content` c LEFT JOIN `{$this->table}` t ON c.id = t.id ORDER BY RAND( )) a";
		//if(){
			$select->addWhere("( a.`date_to` <= '{$time}'  OR a.`date_to` = 0 )")->addWhere("( a.`date_from` >= '{$time}' OR a.`date_from` = 0 )");
		//}
		$result = $select->addFrom($table)->addWhere(" ( (( a.`use_view` <= a.`max_count_view` AND a.`max_count_view` != 0 ) OR a.`max_count_view` = 0 ) AND (( a.`use_price` <= a.`price` AND a.`price` != 0 ) OR a.`price` = 0 ) ) ")->addGroup("a.`id_type`")->queryDB();
		return $result;
	}
	
	function isProjectBaner($id_baner){
		$fmakeProjectCommercialRelation = new fmakeProjectCommercial_relation();
		$fmakeProjectCommercial = new fmakeProjectCommercial();
		$id_project = $fmakeProjectCommercialRelation->getProjectBanerId($id_baner);
		$fmakeProjectCommercial->setId($id_project);
		$info_project = $fmakeProjectCommercial->getInfo();
		return $info_project['active'];
	}
	
	function showBanerType($type,$url){
		$select = $this->dataBase->SelectFromDB( __LINE__);
		
		$time = time(); 
		$table = "(select c.*,t.`picture`,t.`date_create`,t.`active` FROM  `baner_content` c LEFT JOIN `{$this->table}` t ON c.id = t.id ) a";

		$select->addWhere("a.active='1'");
		$select->addWhere("a.`picture`!=''");
		$select->addWhere("( a.`date_to` <= '{$time}'  OR a.`date_to` = 0 )")->addWhere("( a.`date_from` >= '{$time}' OR a.`date_from` = 0 )");

		$result = $select->addFrom($table)->addWhere(" ( (( a.`use_view` <= a.`max_count_view` AND a.`max_count_view` != 0 ) OR a.`max_count_view` = 0 ) AND (( a.`use_price` <= a.`price` AND a.`price` != 0 ) OR a.`price` = 0 ) AND ( a.`id_type` = '{$type}' ) ) ")->queryDB();
		//printAr($result);
		$baners = array();
		if($result)foreach($result as $key=>$item){
			if($this->isProjectBaner($item['id'])){
				if($item['regular_exp']){
					if(preg_match("#^{$item['regular_exp']}$#",$url)){
						//echo $item['regular_exp']." ".$url;
						$baners[] = $item;
					}
				} else {
					$baners[] = $item;
				}
			}
		}
		//printAr($baners);
		if($baners[0]){
			$b = $this->showBanerId($baners[0]['id'],$baners[0]['picture'],$baners[0]['format'],$baners[0]['width'],$baners[0]['height']);
			if($baners[0]['url']){
				$b_url = '<noindex><a rel="nofollow" target="_blank" href="'.$baners[0]['url'].'">'.$b.'</a></noindex>';
				return $b_url;
			} else {
				return $b;
			}
		}
	}
	
	function showBaner($name,$format = false){
		if(!$format) $format = substr($name,1+strrpos($name,"."));
		switch($format){
			case 'swf':
				$str = "<embed src='{$name}' quality='high' type='application/x-shockwave-flash' wmode='opaque' width='100%' height='100%' pluginspage='http://www.macromedia.com/go/getflashplayer' allowScriptAccess='always'></embed>";
				break;
			default:
				$str = "<img width='' src='{$name}' />";
				break;
		}
		return $str;
	}
	
	function showBanerId($id,$name,$format = false,$width = false,$height = false){
		if(!$format) $format = substr($name,1+strrpos($name,"."));
		
		if($width) $width = " width=\"{$width}\" ";
		else $width = "";
		if($height) $height = " height=\"{$height}\" ";
		else $height = "";
		
		switch($format){
			case 'swf':
				
				if(!$width) $width = " width=\"100%\" ";
				if(!$height) $height = " height=\"100%\" ";
				
				$str = "<script>xajax_viewBaner({$id});</script>
						<object
						  type=\"application/x-shockwave-flash\"
						  data=\"/{$this->fileDirectory}{$id}/{$name}\"
						  onclick=\"xajax_clickBaner({$id})\"
						  {$width} {$height}>
							<param name=\"movie\" value=\"/{$this->fileDirectory}{$id}/{$name}\">
							<param name=\"wmode\" value=\"transparent\">
							<param name=\"allowScriptAccess\" value=\"sameDomain\" />
						</object>";
				//$str = "<embed src='/{$this->fileDirectory}{$id}/{$name}' quality='high' type='application/x-shockwave-flash' wmode='opaque' width='100%' height='100%' pluginspage='http://www.macromedia.com/go/getflashplayer' allowScriptAccess='always'></embed>";
				break;
			default:
				$str = "<script>xajax_viewBaner({$id});</script><img {$width} {$height} onclick=\"xajax_clickBaner({$id})\" src='/{$this->fileDirectory}{$id}/{$name}' />";
				break;
		}
		return $str;
	}
	
	/*просмотр банера*/
	function updateUseView($id){
		$table = "`baner_content`";
		$this->dataBase->query("UPDATE {$table} SET `use_view` = `use_view`+1 WHERE {$table}.`id` = {$id} LIMIT 1",__LINE__);
	}
	
	/*просмотр банера*/
	function updateUseViewPage($id){
		$table = "`baner_content`";
		$this->dataBase->query("UPDATE {$table} SET `use_view` = `use_view`+1 WHERE {$table}.`id_post` = {$id}",__LINE__);
	}
	
	/*клик банера*/
	function updateUseClick($id){
		$table = "`baner_content`";
		$this->dataBase->query("UPDATE {$table} SET `use_click` = `use_click`+1 WHERE {$table}.`id` = {$id} LIMIT 1",__LINE__);
	}
	
	function updateUsePrice($id,$type = 'view'){
		$table = "`baner_content`";
		
		$fmakeBanerContent_dop = new fmakeTypeTable();
		$fmakeBanerContent_dop->table = $table;
		$fmakeBanerContent_dop->setId($id);
		$info = $fmakeBanerContent_dop->getInfo();
		if($type == 'click') $price = $info['price_baner_click'];
		else $price = $info['price_baner_view'];
		
		$this->dataBase->query("UPDATE {$table} SET `use_price` = `use_price`+{$price} WHERE {$table}.`id` = '{$id}' LIMIT 1",__LINE__);
	}
	
	function updateUsePricePage($id,$type = 'view'){
		$table = "`baner_content`";
		$select = $this->dataBase->SelectFromDB( __LINE__);
		$result = $select->addfrom($table)->addWhere("`id_post` = '{$id}'")->queryDB();
		
		$fmakeBanerContent_dop = new fmakeTypeTable();
		$fmakeBanerContent_dop->table = $table;
		
		if($result)foreach($result as $key=>$item){
			$price = $item['price_baner_view'];
			$this->dataBase->query("UPDATE {$table} SET `use_price` = `use_price`+{$price} WHERE {$table}.`id` = '{$item[id]}'",__LINE__);
		}
	}
	
	
	
}

?>
