<?php

class fmakeBackup_control extends fmakeCore 
{

	public $table = "site_backup_db";
	public $table_dop = "site_backup_db_tables";
	public $no_backup_tables = array("site_backup_db","site_backup_db_tables");
		
	/**
	 * 
	 * Получить первый элемент со статусом 0
	 *
	 */
	function getItem ()
	{
		$select = $this->dataBase->SelectFromDB( __LINE__);
		$result = $select -> addFrom($this->table_dop) -> addWhere("`status_write` = '0'") -> addLimit(0,1) -> queryDB();
		return $result[0];
	}
	
	/**
	 * 
	 * Проверка целостности backup-ов (если есть какой то недоделанный бекап то выдается название файла иначе false)
	 *
	 */
	function isIntegrityBackup ()
	{
		$select = $this->dataBase->SelectFromDB( __LINE__);
		$result = $select -> addFrom($this->table_dop) -> addWhere("`status_write` = '0'") -> addLimit(0,1) -> queryDB();
		
		$id_site_backup_db = $result[0]['id_site_backup_db'];
		if($id_site_backup_db){
			$select = $this->dataBase->SelectFromDB( __LINE__);
			$result = $select -> addFrom($this->table) -> addWhere("`id` = '{$id_site_backup_db}'") -> addLimit(0,1) -> queryDB();
			return $result[0]['caption'];
		}
		return false;
	}
	
	/**
	 * 
	 * Проверка целостности backup-а с id
	 *
	 */
	function isIntegrityBackupId ($id)
	{
		$select = $this->dataBase->SelectFromDB( __LINE__);
		$result = $select -> addFrom($this->table_dop) -> addWhere("`id_site_backup_db` = '{$id}'") -> addWhere("`status_write` = '0'") -> addLimit(0,1) -> queryDB();
		
		$id_site_backup_db = $result[0]['id_site_backup_db'];
		if($id_site_backup_db){
			$select = $this->dataBase->SelectFromDB( __LINE__);
			$result = $select -> addFrom($this->table) -> addWhere("`id` = '{$id_site_backup_db}'") -> addLimit(0,1) -> queryDB();
			return $result[0]['caption'];
		}
		return false;
	}
	
	/**
	 * 
	 * Выбор таблиц бекапа по id с выбранным статусом
	 *
	 */
	function getTablesStatus ($id_backup,$status = '0')
	{
		$select = $this->dataBase->SelectFromDB( __LINE__);
		$tables = false;
		if ($id_backup)
			$select->addWhere("`id_site_backup_db` = '{$id_backup}'");
		$result = $select -> addFrom($this->table_dop) -> addWhere("`status_write` = '{$status}'") -> addLimit(0,1) -> queryDB();
		
		if ($result) foreach ($result as $key=>$item){
			$tables[] = $item['name'];
		}
		return $tables;
	}
	
	function getIdBackup ($file)
	{
		$select = $this->dataBase->SelectFromDB( __LINE__);
		$result = $select -> addFild("id") -> addFrom($this->table) -> addWhere("`caption` = '{$file}'") -> addLimit(0,1) -> queryDB();
		return $result[0]['id'];
	}
	
	function updateParam ($file,$table,$fild,$param)
	{
		$fmakeBackupControl = new fmakeBackup_control();
		$id = $fmakeBackupControl->getIdBackup ($file);
		$update = $this->dataBase->UpdateDB( __LINE__);
		$update	-> addTable($this->table) -> addFild("`{$fild}`", "'{$param}'", false) -> addWhere("`id_site_backup_db`='{$id}' AND `name`='{$table}'") -> queryDB();
	}
	
	function infoParams ($file,$table)
	{
		$select = $this->dataBase->SelectFromDB( __LINE__);
		
		$fmakeBackupControl = new fmakeBackup_control();
		$id = $fmakeBackupControl->getIdBackup ($file);
		
		$result = $select -> addFrom($this->table) -> addWhere("`id_site_backup_db`='{$id}' AND `name`='{$table}'") -> queryDB();
		return $result[0];
	}
	
	function writeTables ($tables,$id_backup)
	{
		if ($tables) foreach ($tables as $item) {
			if (in_array($item,$this->no_backup_tables)) continue;
			$this->addParam('id_site_backup_db',$id_backup);
			$this->addParam('name',$item);
			$this->newItem();
		}
	}
}

?>
