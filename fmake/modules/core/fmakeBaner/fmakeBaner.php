<?php

/*
CREATE TABLE `baner` (
  `id` int(11) NOT NULL auto_increment,
  `id_type` int(11) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `date_create` int(11) NOT NULL,
  `date_to` int(11) NOT NULL,
  `date_from` int(11) NOT NULL,
  `text` text NOT NULL,
  `active` enum('0','1') NOT NULL default '0',
  `position` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
);
*/

class fmakeBaner extends fmakeCore {

	public $idField = "id";
	public $table = "baner";
	public $fileDirectory = "images/baner/";

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
		$table = "(select * FROM `{$this->table}` ORDER BY RAND( )) a";
		$result = $select->addFrom($table)->addWhere("a.`date_to` <= '{$time}'")->addWhere("a.`date_from` >= '{$time}'")->addGroup("`id_type`")->queryDB();
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
				$str = "<object
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
				$str = "<img src='/{$this->fileDirectory}{$id}/{$name}' />";
				break;
		}
		return $str;
	}
}

?>
