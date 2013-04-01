<?php
class fmakeCount extends fmakeCore {

	public $table = "`statistic`";

	function soCounted($page_id){
		$r = $this->dataBase->query("SELECT * FROM {$this->table} WHERE id = {$page_id}",__LINE__);
		$r = mysql_fetch_row($r);
		if ($r) {				
			$this->dataBase->query("UPDATE {$this->table} SET `count` = `count`+1 WHERE {$this->table}.`id` = {$page_id} LIMIT 1",__LINE__);
		}
		else {
			$this->dataBase->query("INSERT INTO {$this->table} (`id`, `count`) VALUES ({$page_id}, 1)", __LINE__);
		}
	}
	
	function getShortNameNews($limit,$day = 1,$active = true){
		$news_obj = new fmakeNews();
		$select = $this->dataBase->SelectFromDB(__LINE__);
		if ($active)
			$select->addWhere("c.active='1'");
		$table = "`news`";
		if ($table){
			$table_join = " as a LEFT JOIN {$table} as b ON b.id = a.id LEFT JOIN {$news_obj->table} as c ON b.id = c.id";
		}
		if($limit)
			$select->addLimit(0, $limit);
		
		$date_to = strtotime("-{$day} day",strtotime("today"));
		$date_from = strtotime("today");
			
		return $select->addFild("a.id,a.count,b.short_name,c.caption,c.full_url")->addFrom($this->table . $table_join)->addWhere("{$date_to} <= b.`date` AND b.`date` <= {$date_from}")->addWhere("b.`id`!=0 and c.`id`!=0")->addOrder("a.count", "DESC")->queryDB();
	}
	
	
}
?>