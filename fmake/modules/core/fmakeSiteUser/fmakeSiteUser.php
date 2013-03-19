<?php
	/**
	*
	* Пользователь системы
	*/

	class fmakeSiteUser extends fmakeCore{
		
		public $idField = "id_user";
		public $table = "user";
		public $symbols = "23456789abcdeghkmnpqsuvxyz";
		
		public $id; 	// int
		public $login;	// char
		public $type = 'user';	// char
		public $role = 1;	// char
		public $status;	// bool
		public $fileDirectory = "images/users/";
		
		public static $accesObj = false;
		public static $roleObj = false;
		
		
	/**
	 * 
	 * @return fmakeAcces_adminModul
	 */
	function getAccesObj(){
		if(!self::$accesObj){
			self::$accesObj = new fmakeAcces_siteModul();
		}
		return self::$accesObj;
	}
	
	/**
	 * 
	 * @return fmakeSiteAdministratorRole
	 */
	function getRoleObj(){
		if(!self::$roleObj){
			self::$roleObj = new fmakeSiteUser_role();
		}
		return self::$roleObj;
	}	
	
	
	/**
	 * 
	 * поиск по email 
	 * @param string $email что ищем
	 */
	function getByEmail($email){
		$user = $this->getWhere(array("email = '{$email}'"));
		return $user[0];	
	}

	/**
	 * 
	 * поиск по id 
	 * @param integer $id что ищем
	 */
	function getByUserId($id){
		$user = $this->getWhere(array("id_user = {$id}"));
		return $user[0];	
	}
	
	/**
	 *
	 * поиск по type
	 * @param string $type что ищем 
	 */
	function getByType($type){
		$user = $this->getWhere(array("`type` = '{$type}' AND `active` = '1' AND `name` != '' "));
		return $user;	
	}
	/**
	 * 
	 * поиск по login
	 * @param string $login что ищем
	 */
	function getByLogin($login){
		$user = $this->getWhere(array("`login` = '{$login}' AND `active` = '1'"));
		return $user[0];	
	}
	
	/**
	 * 
	 * поиск по id_vk 
	 * @param int $id что ищем
	 */
	function getByIdVk($id){
		$user = $this->getWhere(array("id_vk = '{$id}'"));
		return $user[0];	
	}
	
	/**
	 * 
	 * поиск по id_fb 
	 * @param int $id что ищем
	 */
	function getByIdFb($id){
		$user = $this->getWhere(array("id_fb = '{$id}'"));
		return $user[0];	
	}
	
	/**
	* 
	* Получаем записи по роли
	*/
	function getByRole($role,$active = false){
		
		$where[0] = 'role = '.$role;
		if($active !== false){
			if($active){
				$where[1] = 'active = '.$active;
			}else{
				$where[1] = "active = '0'";
			}
		}
		
		return $this->getWhere($where);	
	}
	
	/**
	 * 
	 * сгенерить пароль
	 */
	function getNewPassword(){
		$length = rand(6, 7);
		$password = '';
		for($i=1; $i<=$length; $i++){
			$password  .= $this->symbols[rand(0, strlen($this->symbols))];
		}	
		return $password;
	}
	
	/**
	 * 
	 * получить хеш подтверждения регистрации
	 * @param string $email что ищем
	 */
	function getAutication($email){
		return md5( $email.rand(1, 20000) );
	}

	
	/**
	 * 
	 * залогинить пользователя
	 * @param string $email
	 * @param string $password
	 */
	function login($login,$password){
		$user = $this -> getByLogin($login);
		if(!$user){
			return false;
		}
		
		if( $user['password'] == md5($password) ){
			$this->id = $user[$this->idField];
			$this->login = $user['login'];
			$this->role = $user['role'];
			//
			$this->status = true;
			$this -> save();
			return true;
		}
		return false;
	}
	
	/**
	 * 
	 * залогинить пользователя
	 * @param string $email
	 * @param string $password
	 */
	function loginCokie($login,$autication){
		$user = $this -> getByLogin($login);
		if(!$user){
			return false;
		}
		
		if($user['cookies'] == $autication){
			$this->id = $user[$this->idField];
			$this->login = $user['name'];
			$this->role = $user['role'];
			$this->status = true;
			$this -> save();
			return true;
		}
		return false;
	}
	
	/**
	 * 
	 * залогинить пользователя
	 * @param string $email
	 * @param string $password
	 */
	function loginAutication($login){
		$user = $this -> getByLogin($login);
		if(!$user){
			return false;
		}
		
		$this->id = $user[$this->idField];
		$this->login = $user['name'];
		$this->role = $user['role'];
		$this->status = true;
		$this -> save();
		return true;
	}
	
	/**
	 * 
	 * разлогинеться
	 */
	public function logout()
	{
		unset($_SESSION[$this->type]);
		$this->status = false;
	}
	/**
	 * 
	 * статус
	 */
	public function isLogined()
	{
		return $this->status;
	}

	
	/**
	 * 
	 * загрузить данные
	 */
	public function load()
	{
		$this->id = $_SESSION[$this->type]['id'];
		$this->login = $_SESSION[$this->type]['login'];
		$this->role = $_SESSION[$this->type]['role'] ? $_SESSION[$this->type]['role'] : $this->role ;
		$this->status = $_SESSION[$this->type]['status'];
	}

	/**
	 * 
	 * сохранить данные
	 */
	public function save()
	{
		$_SESSION[$this->type]['id'] = $this->id;
		$_SESSION[$this->type]['login'] = $this->login;
		$_SESSION[$this->type]['role'] = $this->role;
		$_SESSION[$this->type]['status'] = $this->status;
	}
	
	
	/**
	 * 
	 * добавление файла
	 * @param string $tempName
	 * @param string $name
	 */
	function addFile($tempName, $name) {
		$dirs = explode("/", $this->fileDirectory . '/' . $this->id);
		$dirname = ROOT . "/";
		$name = $this->imgtransliter($name);
		foreach ($dirs as $dir) {
			$dirname = $dirname . $dir . "/";
			if (!is_dir($dirname))
				mkdir($dirname);
		}

		//$wantermark = ROOT.'/images/wantermark2.png';
		
		$images = new imageMaker($name);
		$images->imagesData = $tempName;
		//$images->resize(false,false, false, $dirname, '', false,"wmi|{$wantermark}|BL");
		//$images->resize(false,false, false, $dirname, 'original_', false);
		$images->resize(false,false, false, $dirname, '', false);
		$images->resize(100,80, true, $dirname, '100_80_', false);
		$images->resize(225,300, true, $dirname, '225_300_', false);
		$images->resize(112,169, true, $dirname, '112_169_', false);
		$images->resize(50,50, true, $dirname, '50_50_', false);
		
		//wantermark
		//$images->wantermark_img($dirname.$name,ROOT."/images/wantermark2.png");
		//$images->wantermark_img($dirname."406__".$name,ROOT."/images/wantermark2.png");
		
		$this->addParam('picture', $name); 
		$this->update();
	}
	
	/**
	 * 
	 * добавление файла
	 * @param string $tempName
	 * @param string $name
	 */
	function addFileIdParams($id, $width, $height, $iswantermark = false) {
		$dirs = explode("/", $this->fileDirectory . $id);
		$dirname = ROOT . "/";

		foreach ($dirs as $dir) {
			$dirname = $dirname . $dir . "/";
			if (!is_dir($dirname))
				mkdir($dirname);
		}

		$wantermark = ROOT.'/images/wantermark2.png';
		
		$fmake = new fmakeSiteUser();
		$fmake->setId($id);
		$info = $fmake->getInfo();
		$name = $info['picture'];
		//echo $name.'<br/>';
		$tempName = (is_file($dirname."original_{$name}"))? $dirname."original_{$name}" : $dirname."{$name}";
		
		$images = new imageMaker($name);
		$images->imagesData = $tempName;
		if ($iswantermark) $images->resize($width, $height, true, $dirname, "{$width}_{$height}_", false,"wmi|{$wantermark}|BL");
		else $images->resize($width, $height, true, $dirname, "{$width}_{$height}_", false);
		
	}
}