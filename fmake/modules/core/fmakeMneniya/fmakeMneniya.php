<?php
class fmakeMneniya extends fmakeCore{
	public $table = 'mneniya';
	public $idField = "id";	

	function delete_adm_mod($id_news , $array_not_delete){
		if($id_news){
			$delete = $this ->dataBase -> DeleteFromDB( __LINE__ );
			if($array_not_delete)foreach ($array_not_delete as $NotDelete){
				$delete -> addWhere("`id` != '".$NotDelete."'");
			}
			$delete	-> addTable($this->table) -> addWhere("`id_news`='".$id_news."'") -> queryDB();
		}
	}
	function getByPageAdmin($limit, $page, $where = "", $active = false) {
		$select = $this->dataBase->SelectFromDB(__LINE__);
		if ($active)
			$select->addWhere("expert_active='1'");
		if($where)
			$select->addWhere($where);
		if($this->order) 
			$select->addOrder($this->order, $this->order_as);
		if($this->group_by)
			$select->addGroup($this->group_by);
		if($limit)
			$select->addLimit((($page - 1) * $limit), $limit);
		return $select->addFrom($this->table)->queryDB();
	}
}