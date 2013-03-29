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
		if($id_project){
			$delete = $this->dataBase->DeleteFromDB( __LINE__ );
			$select = $this->dataBase->SelectFromDB(__LINE__);
			if($array_not_delete)foreach ($array_not_delete as $NotDelete){
				$delete -> addWhere("`id_content` != '".$NotDelete."'");
				$select -> addWhere("`id_content` != '".$NotDelete."'");
			}
			
			/*выбираем все элементы которые нужно удалить из site_modul*/
			$result = $select-> addFrom($this->table) -> addWhere("`id_project`='".$id_project."'") -> queryDB();
			
			$fmakeBanerContent = new fmakeBanerContent();
			$id_page_modul = 5585;
			$fmakeTypeTable = new fmakeTypeTable();
			$fmakeBanerContent_dop = new fmakeTypeTable();
			$fmakeBanerContent_dop->table = $fmakeTypeTable->getTable($id_page_modul);
			
			if($result)foreach($result as $key=>$item){
				$fmakeBanerContent->setId($item['id_content']);
				$fmakeBanerContent_dop->setId($item['id_content']);
				$fmakeBanerContent->delete();
				$fmakeBanerContent_dop->delete();
			}
			/*выбираем все элементы которые нужно удалить из site_modul*/
			
			
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
