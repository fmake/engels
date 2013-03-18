<?php
 
 class FBapi {
     public $app_secret = '6ae07d4b5e064bb2d8763011177b00f4';
     private $app_id = '404043026331078';

	public function getAccessToken($code) {
		
        $url = 'https://graph.facebook.com/oauth/access_token?client_id='.$this->app_id.'&redirect_uri=http://'.$_SERVER['HTTP_HOST'].'/fb.php&client_secret='.$this->app_secret.'&code='.$code;
		$curl = new cURL();
		$curl -> init();
		$curl -> get($url);
		$result = $curl -> data();
		$params = null;
		parse_str($result, $params);
		$token = $params['access_token'];
		
		$graph_url = "https://graph.facebook.com/me?access_token=". $params['access_token'];
		$curl -> get($graph_url);
		$result = $curl -> data();
		$user_fb = json_decode($result);
		$user_fb_id = $user_fb->id;
		
		$configs = new globalConfigs();
		$configs ->udateByValue("token_fb", $token);
		$configs ->udateByValue("user_id_fb", $user_fb_id);
    }  
	 
	public function SendWallGroup($post,$id_group) {
				
		$configs = new globalConfigs();
		$token_fb = $configs->getByParam('token_fb');
		
		//https://graph.facebook.com/131901623624097?fields=access_token&access_token=AAAFveZAkO9cYBAF1UeAYTimIjJqx75X4xX8YgQZC0wN4PRLhJsQMvsijSqnGj8wxu7ssq5au1UkLEOpy01qqnVuBitnVwZA9gGq7AyVfwZDZD

		//$token_admin_group = "AAAFveZAkO9cYBADyFB9qdil6WBaZCDPHCnXdZBj7vx4cXLpZAYoSX6Rn51JgCmM2HzPPJEBIp13zZA5g3cJDZBsfXQjfW8FFvD4gVEd58fwH8IZA7e7kWai";
		$token_admin_group = $configs->getByParam('token_fb_group_admin');
		
        $url = 'https://graph.facebook.com/'.$id_group.'/feed?access_token='.$token_admin_group;
		$curl = new cURL();
		$curl -> init();
		$curl -> post($url,$post);
		$result = $curl -> data();
		$result = json_decode($result);
		return $result;
    } 
    
	public function isUserToken($tocken){

		$graph_url = "https://graph.facebook.com/me?access_token=". $tocken;
		$curl = new cURL();
		$curl -> init();
		$curl -> get($graph_url);
		$result = $curl -> data();
		$user_fb = json_decode($result);
		$result = $user_fb;
		
		return $result;
	}
	
    public function login($code,$redir_url = false) {
		if (!$redir_url) $redir_url = "http://{$_SERVER['HTTP_HOST']}";
        $url = 'https://graph.facebook.com/oauth/access_token?client_id='.$this->app_id.'&redirect_uri='.$redir_url.'&client_secret='.$this->app_secret.'&code='.$code;
		$curl = new cURL();
		$curl -> init();
		$curl -> get($url);
		$result = $curl -> data();
		//echo $result;
		//exit();
		$params = null;
		 parse_str($result, $params);
		 $graph_url = "https://graph.facebook.com/me?access_token=". $params['access_token'];

		// $user = json_decode(file_get_contents($graph_url));
		$curl -> get($graph_url);
		$result = $curl -> data();
		$user_fb = json_decode($result);
		 //echo("Hello " . $user_fb->id);
		$user_fb_id = $user_fb->id;
		$user_fb_nickname = $user_fb->username;
		if($user_fb_id){
			$userObj = new fmakeSiteUser();
			$user = $userObj->getByIdFb($user_fb_id);
			if(!$user){
				$userObj->addParam("login","fb{$user_fb_id}");
				$userObj->addParam("id_fb", $user_fb_id);
				$userObj->addParam("name_social","{$user_fb_nickname}");
				$userObj->addParam("post_create", 0);
				$userObj->addParam("active", 1);
				$userObj->newItem();
				$user = $userObj->getInfo();
			}
			$picture_social_link = "http://graph.facebook.com/{$user_fb_id}/picture";
			$fmakeSiteUser = new fmakeSiteUser($user[$userObj->idField]);
			$fmakeSiteUser->addParam("picture_social_link", $picture_social_link);
			$fmakeSiteUser->update();
			
			$userObj->id = $user[$userObj->idField];
			$userObj->login = $user['login'];
			$userObj->role = $user['role'];
			$userObj->status = true;
			$userObj -> save();
						
			
			return true;
		}
		return false;
    }   
 }
 ?>