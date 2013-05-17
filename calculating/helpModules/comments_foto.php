<?php
	//$limit_comment = 10;
	$fmakeComments = new fmakeComments_foto();
	$comments = $fmakeComments->getByPage($id,$limit_comment,1,true);
	$count = $fmakeComments->getByPageCount($id,true);
	//$pages = ceil($count/$limit_comment);
	//if($pages>1) $is_more_link = true;
	//else $is_more_link = false;
	
	if ($comments) foreach($comments as $k=>$c) {
		$fmakeSiteUser = new fmakeSiteUser();
		$fmakeSiteUser->setId($c['id_user']);
		$user_params = $fmakeSiteUser->getInfo();
		if(!$user_params){$user_params['name_social'] = $comments[$k]['name'];}
		$comments[$k]['user_params'] = $user_params;
		$comments[$k]['text'] = stripslashes($c['text']);
	}
	
	$globalTemplateParam->set('comments',$comments);
	//$globalTemplateParam->set('limit_comment',$limit_comment);
	$globalTemplateParam->set('include_param_id_comment',$id);
	$globalTemplateParam->set('is_more_link',$is_more_link);

	