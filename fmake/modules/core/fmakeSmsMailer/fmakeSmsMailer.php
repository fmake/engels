<?php

class fmakeSmsMailer extends fmakeCore {

	public $idField = "id";
	public $table = "sms_mailer";
	
	function getItemsUserId ($id_user, $active = false) {
		
		$select = $this->dataBase->SelectFromDB( __LINE__);
		if($active)
			$select -> addWhere("active='1'");
		return $select -> addFrom($this->table)->addWhere("`id_user` = {$id_user}") -> queryDB();
		
	}
	
}

?>
