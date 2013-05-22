<?php
class fmakeOnline extends fmakeSiteModule{
    public $table = "online_user";

    public function getOnlineUser($page_id, $user_time){
        $select = $this->dataBase->SelectFromDB(__LINE__);
        $where = "page_id = {$page_id} and `date` >= ({$user_time}-60) and `date` <= {$user_time}";
        if($where)
            $select->addWhere($where);
        $result = $select->addFild("DISTINCT `ip` ")->addFrom($this->table)->queryDB();
        return $result;
    }
}