<?php
class fmakeRassilka extends fmakeCore{
		
	public $table = "site_rassilka";	
	public $order = "id";

	function isLastDate(){
		$select = $this->dataBase->SelectFromDB( __LINE__);
		$result = $select -> addFrom($this->table)->addOrder($this->order,DESC) -> queryDB();
		return $result[0]['date_create'];
	}
	
}