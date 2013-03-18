<?php

/*

CREATE TABLE `project_commercial_to_content` (
  `id_project` int(11) NOT NULL,
  `id_content` int(11) NOT NULL,
  `count_view` int(11) NOT NULL,
  PRIMARY KEY  (`id_project`,`id_content`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

*/

class fmakeProjectCommercial_relation extends fmakeCore {

	public $idField = "id_project";
	public $table = "project_commercial_to_content";

	function addPageRelation($id_project,$id_content){
		$this->addParam('id_project',$id_project);
		$this->addParam('id_content', $id_content);
		$this->newItem();
	}
	
	function deleteRelation($id_project,$array_not_delete){
		if($id_project && $array_not_delete){
			$delete = $this->dataBase->DeleteFromDB( __LINE__ );

			foreach ($array_not_delete as $NotDelete){
				$delete -> addWhere("`id_content` != '".$NotDelete."'");
			}
			
			$delete	-> addTable($this->table) -> addWhere("`id_project`='".$id_project."'") -> queryDB();
		}
	}
	
	/**
	 * 
	 * Создание нового объекта, с использованием массива params, c учетов поля position
	 */
	function newItem(){
		$insert = $this->dataBase->InsertInToDB(__LINE__);	
			
		$insert	-> addTable($this->table);
		$this->getFilds();
		
		if($this->filds){
			foreach($this->filds as $fild){
				if(!isset($this->params[$fild])) continue; 
				$insert -> addFild("`".$fild."`", $this->params[$fild]);
			}
			
		}
		$insert->queryDB();
	}
	
	function getContentId($id_project){
		$items = $this->getWhere(array("`id_project` = '{$id_project}'"));
		if($items)foreach($items as $key=>$item){
			if($key==0) $str .= $item['id_content'];
			else $str .= ",".$item['id_content'];
		}
		return $str;
	}
}

?>
