<?php

class fmakeImmovables extends fmakeSiteModule {

	public $table_type = "type_immovables";
	private $array_cat = false;

	function getFilter($filters,$select)
	{
		if ($filters) foreach ($filters as $key=>$item) {
			if ($item) {
				switch ($key){
					case 'count_room':
						if ($item) {
							$str_query_room = " ( ";
							foreach ($item as $key_room=>$count_room) {
								if ($key_room == 0) {
									if ($count_room == 4) $str_query_room .= "b.`{$key}` >= 4";
									else $str_query_room .= "b.`{$key}` = {$count_room}";
								} else {
									if ($count_room == 4) $str_query_room .= " OR b.`{$key}` >= 4";
									else $str_query_room .= " OR b.`{$key}` = {$count_room}";
								}
							}
							$str_query_room .= " ) ";
							$select -> addWhere("{$str_query_room}");
						}
						break;
					case 'price':
						if ($item['to']) {
							$select -> addWhere("b.`{$key}` >= {$item['to']}");
						}
						if ($item['from']) {
							$select -> addWhere("b.`{$key}` <= {$item['from']}");
						}
						break;
					case 'type':
						$select -> addWhere("b.`{$key}` = '{$item}'");
						break;
					default:
						$select -> addWhere("a.`{$key}` = '{$item}'");
						break;
				}
			}
		}
	}
	
	public function getScriptItemAdmin($id_content)
	{
		$this->setId($id_content);
		$item = $this->getInfo();
		$script = "array_place = {";

		$fmakeTypeTable = new fmakeTypeTable();
		$absitem_dop = new fmakeTypeTable();
		$absitem_dop->table = $fmakeTypeTable->getTable(1238);
		$absitem_dop->setId($item['id']);
		$item_dop = $absitem_dop->getInfo();
		
		/*if($dop_param){
			$script .= "'name':'{$item[caption]}','redir':'{$url_page}','addres':'{$item_dop[addres]}','addres_coord':'{$item_dop[addres_coord]}','image':'/{$this->fileDirectory}{$item[id]}/100_80_{$item[picture]}'";
		}else{*/
			$script .= "'name':'{$item[caption]}','redir':'{$url_page}','addres':'{$item_dop[addres]}','addres_coord':'{$item_dop[addres_coord]}','image':'/{$this->fileDirectory}{$item[id]}/100_80_{$item[picture]}'";
		//}

		$script .= "}";
		return $script;
		
	}
	
	function getChilds($id = null, $active = false, $inmenu = false,$where = false,$count_advert = false)
	{
		//echo('childs '.$type.'<br/>');
		if ($id === null)
			$id = $this->id;

		$select = $this->dataBase->SelectFromDB(__LINE__);

		if ($active)
			$select->addWhere("active='1'");
		if ($inmenu)
			$select->addWhere("inmenu='1'");
		if($where)
			$select->addWhere($where);
		if($count_advert){
			$join_table = " LEFT JOIN (SELECT `parent`,COUNT('*') as count FROM `site_modul` WHERE `active`='1' AND file='item_immovables' GROUP BY parent) as b ON a.id = b.parent ";
			$fild = ",b.count";
			//echo 'qq';
		}	
			
		return $select->addFild("a.*".$fild)->addFrom($this->table." as a".$join_table)->addWhere("a.`parent`='" . $id . "'")->addOrder($this->order)->queryDB();
	}
	
	function getCatAsTree($parent = 0, $level = 0, $active = false, $inmenu = false, $level_vlojennost = false)
	{
		//$array = array(2,3,4,6);
		if ($level != $level_vlojennost || !$level_vlojennost) {
			$level++;
			$items = $this->getChilds($parent, $active, $inmenu);
			//printAr($items);
			if ($items) {
				foreach ($items as $item) {
					if ($item['delete_security'] || $item['file']=='item_immovables')
						continue;
					$item['level'] = $level;
					$this->tree[] = $item;
					$this->getCatAsTree($item['id'], $level, $active, $inmenu, $level_vlojennost);
				}
			}
		}
		return $this->tree;
	}
	
	function getCatForMenu($parent = 0, $active = false, $inmenu = false,$count_advert = false)
	{
		$items = $this->getChilds($parent, $active, $inmenu, "`file` != 'item_immovables'",$count_advert);
		//printAr($items);
		if (!$items)
			return;
		foreach ($items as $key => $item) {
			if ($item['delete_security'] || $item['file']=='item_immovables')
				continue;
			$items[$key]['child'] = $this->getCatForMenu($item['id'], $active, $inmenu,$count_advert);
		}
		return $items;
	}
	function getHtmlSelectCat($parent,$name_select = 'parent',$id_parent = false)
	{
		$items = $this->getCatForMenu($parent);
		$html = "<select name=\"{$name_select}\">";
		if($items)foreach($items as $key=>$item){
			$html .= "<option ".(($id_parent==$item[id])? 'selected': '')." value=\"{$item[id]}\">{$item[caption]}</option>";
			
			if($item['child'])foreach($item['child'] as $c_key=>$c_item){
				$html .= "<option style=\"padding-left:20px;\" ".(($id_parent==$c_item[id])? 'selected': '')." value=\"{$c_item[id]}\">{$c_item[caption]}</option>";
			}
			
		}
		$html .= "</select>";
		return $html;
	}
	
	function getCats($parent, $active = false)
	{
		$items = $this->getChilds($parent, $active, false);
		if ($items) {
			foreach ($items as $item) {
				if ($item['delete_security'] || $item['file']=='item_immovables')
					continue;
				$this->array_cat[] = $item['id'];
				$this->getCats($item['id'], $active);
			}
		}
		//printAr($this->array_cat);
		if($this->array_cat){
			foreach($this->array_cat as $key=>$item){
				if($key==0) $str .= $item;
				else $str .= ",".$item;
			}
			$str .= ",".$parent;
		}
		else{
			$str = $parent;
		}
		return $str;
	}
	
	function setParamLink($link) 
	{
		$select = $this->dataBase->SelectFromDB(__LINE__);
		$result = $select->addFild("id")->addFrom("immovables")->addWhere("`link_site` = '" . $link . "'")->queryDB();
		$this->id = $result[0][$this->idField];
	}
	
	function updateActiveParseItem ($active = 0) 
	{
		$update =  $this->dataBase->UpdateDB( __LINE__);
		$table = "immovables";
		$table_join = " as a LEFT JOIN {$table} as b ON b.id = a.id ";
		$update	-> addTable($this->table . $table_join) -> addFild("a.`active`", $active) -> addWhere(" b.`link_site` != '' ") -> queryDB();
	}
	
	function parserObject($page)
	{
		//$page = 4;
		$curl = new  cURL();
		$curl -> init();
		/*
		http://www.s-mls.ru/find-realty/search.php
		?searchtype=distr
		&operations=sale //операция (sale-продажа;rent-аренда;exchange-обмен)
		&realty_type_id=2 //тип объекта
		&realty_subtype_list=
		&chkDistrictsList=12;8 //города
		&chkMicroDistrictsList=
		&floor_cond=0
		&floor_limit_NFF=false
		&floor_limit_NLF=false
		&floor_limit_ONF=false
		&price_from=
		&price_to=
		&square_from=
		&square_to=
		&rpp=0 //без страниц (по сколько выдавать)
		&p=1
		&sortby=
		*/
		
		$curl -> get("http://www.s-mls.ru/find-realty/search.php?searchtype=distr&operations=sale&realty_type_id=2&realty_subtype_list=&chkDistrictsList=12;8&chkMicroDistrictsList=&floor_cond=0&floor_limit_NFF=false&floor_limit_NLF=false&floor_limit_ONF=false&price_from=&price_to=&square_from=&square_to=&rpp=0&p=1&sortby=");
		//echo $curl -> data;

		$pattern2 = "#<table id=\"results_table\"[^>]+>(.+?)</table>#is";
		preg_match_all($pattern2, $curl -> data, $out);
		$pattern2 = "#<tr[^>]+>(.+?)</tr>#is";
		preg_match_all($pattern2, $out[1][0], $out);
		$ans = ($out[1]);
		$data = array();
		for ($i = 0; $i < sizeof($ans); $i++) {
			if(!$ans[$i])break;
			$item = array();
			$pattern2 = "#<td[^>]*>(.+?)</td>#is";
			preg_match_all($pattern2, $ans[$i], $dataAns);
			//print_r($dataAns[1]);
			$dataAns = $dataAns[1];
			$item['city'] = trim($dataAns[1]);
			$item['micro_city'] = trim($dataAns[2]);
			$item['addres'] = trim($dataAns[3]);
			$item['count_room'] = trim(str_replace("к", "", $dataAns[4]) );
			$item['floor'] = trim($dataAns[5]);
			$item['general_area'] = trim($dataAns[6]);
			$item['price'] = trim($dataAns[7]);
			$pattern2 = "#href=\"(.+?)\"#is";
			preg_match_all($pattern2, $dataAns[0], $link);
			$item['link'] = $link[1][0];
			
			$data[] = $item;
		}
		return $data;
	}
	
	function parserVnutr($link)
	{
		$curl = new  cURL();
		$curl -> init();
		$curl -> get($link);
		
		$pattern1 = "#<table id=\"realty-data-table\"[^>]+>(.+?)</table>#is";
		preg_match_all($pattern1, $curl -> data, $out);
		$tmp = $out[1][1];
		$out = false;
		$pattern2 = "#<td>(.+?)</td>[\s]*</tr>#is";
		preg_match_all($pattern2, $tmp, $out);
		$array = array(
			"agent"=>$out[1][0],
			"agentstvo"=>$out[1][1]);
		return $array; 
		//return $out;
	}
}

?>
