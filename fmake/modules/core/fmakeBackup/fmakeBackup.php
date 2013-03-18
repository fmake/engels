<?php

class fmakeBackup extends fmakeCore 
{

	public $table = false;
	public $tables = false;
	public $file = false;
	public $fileDirectory = "/upload-files/";
	
	function setIdFileName() {
		$fmakeBackupControl = new fmakeBackup_control();
		$id = $fmakeBackupControl->getIdBackup ($this->file);
		//echo $id;
		$this->id = $id;
	}
	
	/**
	 * 
	 * получаем поля таблицы
	 */
	function getTables()
	{
		$r = $this->dataBase->query("SHOW TABLES", __LINE__);
		if ($r && $this->dataBase->num_rows($r)){
			
			while ($obj = $this->dataBase->fetch_array()){
				$this->tables[] = $obj[0];
			}
		}
	}
	/**
	 * 
	 * получаем структуру таблицы
	 */
	function getTableStruct()
	{
		$r = $this->dataBase->query("SHOW CREATE TABLE `{$this->table}` ;", __LINE__);
		if ($r && $this->dataBase->num_rows($r)){
			$obj = $this->dataBase->fetch_array();
		}
		return $obj['Create Table'].";";
	}
	//SHOW COLUMNS FROM `admin_modul` 
	/**
	 * 
	 * получаем поля таблицы
	 */
	function getTableFields()
	{
		unset($this->filds);
		$r = $this->dataBase->query("SHOW COLUMNS FROM `{$this->table}` ;", __LINE__);
		if ($r && $this->dataBase->num_rows($r)){
			while ($obj = $this->dataBase->fetch_array()){
				$this->filds[] = $obj['Field'];
			}
		}
	}
	
	/**
	 * 
	 * Получить все записи в таблице
	 * @param bool $active учитывать выключенные
	 * @return array все имеющиеся записи в таблице
	 */
	function getAll () 
	{
		
		$select = $this->dataBase->SelectFromDB( __LINE__);
		return $select -> addFrom($this->table) -> queryDB();
		
	}
	/**
	 * 
	 * получить записи из интервала
	 * @param $limit лимит записей
	 * @param $page с какой страницы начинаем
	 */
	function getByPage($limit, $page) {
		
		$select = $this->dataBase->SelectFromDB( __LINE__);
		return $select -> addFrom($this->table) -> addLimit((($page-1)*$limit), $limit) -> queryDB();
	}
	

	function addInsert($file,$item,$filds) 
	{
		$SQL = "INSERT INTO `".$this->table."` VALUES (";
		$i = 1;
		$size_filds = sizeof($filds);
		foreach($filds as $fild)
		{
			$SQL .= "'" . str_replace("'","&#39;",$item[$fild]) . "'" . (($i != $size_filds)? ', ':'') . "";
			$i++;
		}
		$SQL .= ");\n";

		if (is_file($file)) {
			$handle = fopen($file, "a");
		} else {
			$handle = fopen($file, "w+");
		}
		fwrite($handle, $SQL);
		fclose($handle);
	}
	function addTableStruct($file) 
	{
		//записываем структуру таблицы
		$SQL = "\n".$this->getTableStruct()."\n\n";

		if (is_file($file)) {
			$handle = fopen($file, "a");
		} else {
			$handle = fopen($file, "w+");
		}
		fwrite($handle, $SQL);
		fclose($handle);
	}
	
	/**
	 * 
	 * Бекап основной таблицы
	 */
	function backUpTable($path,$update = false) 
	{
		$fmakeBackupControl = new fmakeBackup_control();
		$fmakeBackupControlTables = new fmakeBackup_control();
		$fmakeBackupControlTables->table = $fmakeBackupControlTables->table_dop;
	
		if ($update) {
			$params = $fmakeBackupControlTables->infoParams($this->file,$this->table);
			if ($params['line_stop'] <= 0) $this->addTableStruct($path.$this->file);
		} else {
			$this->addTableStruct($path.$this->file);
		}
		
		$this -> getTableFields();
		
		$arr = $this -> getAll();
		if (!$this->file) $this->file = "backup_site".date("Y-m-d-H-i").".sql";
		if($arr) foreach($arr as $key=>$row)
		{
			if ($update && $key < intval($params['line_stop'])) {
				//echo $key." < ".$params['line_stop'];
				continue;
			}
			$this->addInsert($path.$this->file,$row,$this->filds);
			
			$fmakeBackupControlTables->updateParam($this->file,$this->table,'line_stop',$key+1);
		}
		
		$fmakeBackupControlTables->updateParam($this->file,$this->table,'status_write','1'); 
		
	}
	
}

?>
