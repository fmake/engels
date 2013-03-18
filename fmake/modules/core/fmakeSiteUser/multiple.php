<?php

	class fmakeSiteUser_multiple extends fmakeCore
	{
		
		public $idField = "id_site_modul";
		public $table = "user_multiple_oblast_expert";
		
		function isItemParent($parent,$id_user)
		{
			$item = $this->getWhere(array("`id_user` = '{$id_user}'","`{$this->idField}` = '{$parent}'"));
			return $item[0];
		}
		
		function ItemsParent($parent)
		{
			$items = $this->getWhere(array("`{$this->idField}` = '{$parent}'"));
			return $items;
		}
		
		function addItemParent($parent,$id_user)
		{
			$item = $this->isItemParent($parent,$id_user);
			if (!$item) {
				$this -> addParam($this->idField,$parent);
				$this -> addParam("id_user",$id_user);
				$this ->newItem();
			}
			return $parent;
		}

		function addParents($arrayParents, $id_user)
		{
			if ($arrayParents) {
				global $request ;
				$parentsNotDelete = array();
				foreach ($arrayParents as $key=>$item) {
					$parentsNotDelete[] = $this -> addItemParent($item, $id_user);
				}
			}
			
			// удаляем те что не нужны больше
			//printAr($parentsNotDelete);
			$delete = $this->dataBase->DeleteFromDB( __LINE__ );
			if ($parentsNotDelete) {
				foreach ($parentsNotDelete as $parentNotDelete) {
					$delete -> addWhere("`".$this->idField."` != '".$parentNotDelete."'");
				}
			}
			$delete	-> addTable($this->table) -> addWhere("`id_user`='".$id_user."'") -> queryDB();
		}
		
	}
?>