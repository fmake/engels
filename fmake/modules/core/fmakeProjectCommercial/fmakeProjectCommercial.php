<?php

/*
CREATE TABLE `project_commercial` (
  `id` int(11) NOT NULL auto_increment,
  `id_user` int(11) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `date_create` int(11) NOT NULL,
  `date_to` int(11) NOT NULL,
  `date_from` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `price_use` int(11) NOT NULL,
  `text` text NOT NULL,
  `active` enum('0','1') NOT NULL default '1',
  `position` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE `project_commercial_to_content` (
  `id_project` int(11) NOT NULL,
  `id_content` int(11) NOT NULL,
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
*/

class fmakeProjectCommercial extends fmakeCore {

	public $idField = "id";
	public $table = "project_commercial";

	function setDate($date,$format = "d.m.Y"){
		return date($format,$date);
	}
	
	function getProjectToUserId($id_user){
		$select = $this->dataBase->SelectFromDB( __LINE__);
		if ($active)
			$select->addWhere("a.active='1'");
		$time = time();
		$result = $select->addFrom($this->table)->addWhere("`id_user` = {$id_user}")->queryDB();
		return $result;
	}
}

?>
