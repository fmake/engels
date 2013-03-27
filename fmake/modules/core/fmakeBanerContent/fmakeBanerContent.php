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
	/*public $type_baners = array(
				"0"=>"Банер главная (721x85)",
				"1"=>"Банер главная (349x117)",
				"2"=>"Банер главная (987x135)",
				"3"=>"Банер главная (201x175)",
				"4"=>"Банер главная (982x-)",
				"21"=>"Банер главная между недвижимостью и объявлениями (473x-)",
				"16"=>"Банер главная (лента новостей) 1 (270x-)",
				"17"=>"Банер главная (лента новостей) 2 (270x-)",
				"5"=>"Банер новости1 (221x-)",
				"6"=>"Банер новости2 (221x-)",
				"19"=>"Банер новости (740x-)",
				"7"=>"Банер места1 (221x-)",
				"8"=>"Банер места2 (221x-)",
				"9"=>"Банер афиша1 (221x-)",
				"10"=>"Банер афиша2 (221x-)",
				"11"=>"Банер интервью (221x-)",
				"12"=>"Банер объявления1 (221x-)",
				"13"=>"Банер объявления2 (221x-)",
				"14"=>"Банер недвижимость1 (221x-)",
				"15"=>"Банер недвижимость2 (221x-)",
				"18"=>"Банер справочник (221x-)",
				"20"=>"Банер справочник G2(221x-)"
			);
	public $price_baners = array(
				"0"=>"0.06",
				"1"=>"0.10",
				"2"=>"0.07",
				"3"=>"0.10",
				"4"=>"0.10",
				"5"=>"0.10",
				"6"=>"0.10",
				"7"=>"0.10",
				"8"=>"0.10",
				"9"=>"0.10",
				"10"=>"0.10",
				"11"=>"0.10",
				"12"=>"0.10",
				"13"=>"0.10",
				"14"=>"0.10",
				"15"=>"0.10",
				"16"=>"0.10",
				"17"=>"0.10",
				"18"=>"0.05",
				"19"=>"0.05",
				"20"=>"0.05",
				"21"=>"0.05"
			);*/
	
	
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
		//select * FROM (select * FROM `baner` ORDER BY RAND( )) a Group by `id_type`;
		
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
	
	function showBanerId($id,$name,$format = false){
		if(!$format) $format = substr($name,1+strrpos($name,"."));
		switch($format){
			case 'swf':
				$str = "<script>xajax_viewBaner({$id});</script>
						<object
						  type=\"application/x-shockwave-flash\"
						  data=\"/{$this->fileDirectory}{$id}/{$name}\"
						  width=\"100%\" height=\"100%\">
							<param name=\"movie\" value=\"/{$this->fileDirectory}{$id}/{$name}\">
							<param name=\"wmode\" value=\"transparent\">
							<param name=\"allowScriptAccess\" value=\"sameDomain\" />
						</object>";
				//$str = "<embed src='/{$this->fileDirectory}{$id}/{$name}' quality='high' type='application/x-shockwave-flash' wmode='opaque' width='100%' height='100%' pluginspage='http://www.macromedia.com/go/getflashplayer' allowScriptAccess='always'></embed>";
				break;
			default:
				$str = "<script>xajax_viewBaner({$id});</script><img src='/{$this->fileDirectory}{$id}/{$name}' />";
				break;
		}
		return $str;
	}
	
	function updateUseView($id){
		$table = "`baner_content`";
		/*$update =  $this->dataBase->UpdateDB( __LINE__);
		$update	-> addTable($table) -> addFild("`use_view`", "`use_view`+1") -> addWhere("`id` = '".$id."'") -> queryDB();*/
		$this->dataBase->query("UPDATE {$table} SET `use_view` = `use_view`+1 WHERE {$table}.`id` = {$id} LIMIT 1",__LINE__);
	}
	
	function updateUsePrice($id){
		$table = "`baner_content`";
		
		$fmakeBanerContent_dop = new fmakeTypeTable();
		$fmakeBanerContent_dop->table = $table;
		$fmakeBanerContent_dop->setId($id);
		$info = $fmakeBanerContent_dop->getInfo();
		$price = floatval($info['price_baner_view']);
		
		/*$update =  $this->dataBase->UpdateDB( __LINE__);
		$update	-> addTable($table) -> addFild("`use_price`", "`use_price`+{$price}") -> addWhere("`id` = '".$id."'") -> queryDB();*/
		$this->dataBase->query("UPDATE {$table} SET `use_price` = `use_price`+{$price} WHERE {$table}.`id` = {$id} LIMIT 1",__LINE__);
		//return $price;
	}
}

?>
