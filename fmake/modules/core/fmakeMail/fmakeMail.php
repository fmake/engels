<?php
	class fmakeMail extends fmakeCore{
		
		public $table = "go_mail";
		public $idField = "id";
		public $symbols = "23456789abcdeghkmnpqsuvxyz";
		public $id; 	// int
		public $status;	// bool

	/**
	 * 
	 * отписка от рассылки если такой пользователь есть в системе
	 */
	function isUserRassilka($email,$id) {
		
		$select = $this->dataBase->SelectFromDB( __LINE__);
		if($active)
			$select -> addWhere("active='1'");
		$result = $select -> addFrom($this->table)->addWhere("mail='".$email."'")->addWhere("id='".$id."'") -> queryDB();
		$user = $result[0];
		if($user){
			$this->id = $user[$this->idField];
			$this->status = true;
			$this->setId($user[$this->idField]);
			$this->delete(); 
			return true;
		}
		else{
			return false;
		}
	}
		
	}