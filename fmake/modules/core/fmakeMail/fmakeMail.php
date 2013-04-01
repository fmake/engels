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
	function getByPageAdmin($limit, $page, $where = "", $active = false) {
		$select = $this->dataBase->SelectFromDB(__LINE__);
		if ($active)
			$select->addWhere("a.active='1'");
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