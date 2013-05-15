<?php

/* ------------вспомогательные функции----------------- */

/* ------------вспомогательные функции----------------- */

require_once (ROOT . "/fmake/libs/xajax/xajax_core/xajax.inc.php");
//$xajax = new xajax();
$xajax = new xajax("/index.php");
$xajax->configure('decodeUTF8Input', true);
if($_GET['debug']==1 && $_GET['key']=='5523887') $xajax->configure('debug',true);
$xajax->configure('javascript URI', '/fmake/libs/xajax/');
/* регистрация функции */
$xajax->register(XAJAX_FUNCTION, "viewBaner");
$xajax->register(XAJAX_FUNCTION, "clickBaner");
$xajax->register(XAJAX_FUNCTION, "addStar");
$xajax->register(XAJAX_FUNCTION, "sendLetter");
$xajax->register(XAJAX_FUNCTION, "moreComments");
$xajax->register(XAJAX_FUNCTION, "getMeetsMain");
$xajax->register(XAJAX_FUNCTION, "getMainVote");
$xajax->register(XAJAX_FUNCTION, "SiteCount");
$xajax->register(XAJAX_FUNCTION, "TapeWave");
$xajax->register(XAJAX_FUNCTION, "TapeWaveTab");
$xajax->register(XAJAX_FUNCTION, "gogoMail");
$xajax->register(XAJAX_FUNCTION, "htmlforcolorbox");
$xajax->register(XAJAX_FUNCTION, "formFoto");
$xajax->register(XAJAX_FUNCTION, "mainMeets");
/* регистрация функции */

/* написание функции */
function mainMeets(){
	$objResponse = new xajaxResponse();
	global $twig,$globalTemplateParam, $id_foto;
	return $objResponse;
}
function formFoto($values, $id, $last_id){
	$objResponse = new xajaxResponse();
	global $twig,$globalTemplateParam, $id_foto;
	require_once ROOT.'/fmake/libs/login.php';
	$name = htmlspecialchars(substr($values['name_comment'], 0, 100));
	$text = htmlspecialchars(substr($values['text'], 0, 3000));
	$code = htmlspecialchars(substr($values['picode'], 0, 5));

	if (md5($code) != $_SESSION['code_foto']){
		//$temp_argument = md5($code);
		//$objResponse->alert($temp_argument);
		//$objResponse->alert($_SESSION['code_foto']);
		$script = "$(\"#form_foto_for_comments .error\").html(\"Вы ввели капчу не правильно. <br />\");setTimeout('$.colorbox.resize()', 1);";
		$objResponse->script($script);
	}
	else{
		$script = "$('#form_foto_for_comments .textarea').val('');$('#form_foto_for_comments .error').html('');$('#form_foto_for_comments .captcha').val('');$('#form_foto_for_comments .name').val('');$('#form_foto_for_comments .sucless').html('Ваше сообщение отправлено.<br />');$('#form_foto_for_comments .error').html('');setTimeout('$.colorbox.resize()', 1);";
		//$script += "$(\"#form_foto_for_comments .captcha\").val(\"\");";
		//$script += "$(\"#form_foto_for_comments .name\").val(\"\");";
		//$script += "$(\"#form_foto_for_comments .sucless\").html('Ваше сообщение отправлено.'');";
		//$script += "$(\"#form_foto_for_comments .error\").html('');";
		//$objResponse->alert($script);
		$objResponse->script($script);
		//$objResponse->alert($last_id);
		$fmakeComments = new fmakeComments_foto();
		$fmakeComments->addParam("name",$name);
		$fmakeComments->addParam("id_content", $id);
		$fmakeComments->addParam("id_user",$user->id);
		$fmakeComments->addParam("text",$text);
		$fmakeComments->addParam("date",time());
		$fmakeComments->addParam("active",1);
		$fmakeComments->newItem();
		$objResponse->assign("c_n", "src", "/getpicture_foto.php");
		$comments = $fmakeComments->getByPage($id,5,1,true);

		if ($comments) foreach($comments as $k=>$c) {
			if ($comments[$k]['id'] > $last_id){
				$fmakeSiteUser = new fmakeSiteUser();
				$fmakeSiteUser->setId($c['id_user']);
				$user_params = $fmakeSiteUser->getInfo();
				$comments[$k]['user_params'] = $user_params;
				$comments[$k]['text'] = stripslashes($c['text']);
			}else{
				unset($comments[$k]);
			}
		}
		$objResponse->script("$.colorbox.resize();");
		$globalTemplateParam->set('comments',$comments);
		$globalTemplateParam->set('include_param_id_comment',$id);
		$last = $twig->loadTemplate("xajax/comments/item_add.tpl")->render($globalTemplateParam->get());
		$objResponse->prepend("newcomments", "innerHTML", $last);
		//$objResponse->alert($last);
	}
	//$objResponse->alert($_SESSION['code_foto']);
	//$objResponse->alert($_SESSION['code']);
	//$values = serialize($values);
	//json_decode($values);
	//$objResponse->alert($text);
	//$objResponse->alert($name);
	//$objResponse->alert($code);
	return $objResponse;
}
/* загружает коменты для колорбокса */
function htmlforcolorbox($id){
	$objResponse = new xajaxResponse();
	global $twig, $globalTemplateParam, $id_foto;
	$id_foto = $id;
	//$objResponse->alert($id);
	include_once ROOT.'/fmake/libs/login.php';
	include_once ROOT.'/calculating/helpModules/comments_foto.php';
	$globalTemplateParam->set('id_foto', $id);
	$text = $twig->loadTemplate("xajax/comments/main.tpl")->render($globalTemplateParam->get());
	json_encode($text);

	/*такой бред*/

	//str_replace(" ","",$text);
	//str_replace("\"", "'", $text);
	//str_replace("\r", "", $text);
	//str_replace("\n", "", $text);
	///str_replace("\t", "", $text);
	//str_replace('#\#', "#\\#", $text);
	//$text =  htmlspecialchars($text);
	//$text = "12341234";
	//$text = is_string($text);
	//$script = "__code = $text;";
	//$script = "showhtml($text);";
	//$script = "__code = \"qrwq\"; ";
	//$objResponse->alert($text);
	//$objResponse->script($script);
	//$objResponse->append("cboxLoadedContent", "innerHTML", $text);

	/*конец такого бреда*/

	//$objResponse->call("showhtml", $text);
	//$objResponse->script("__code = $text;");
	// как можно было использовать это? просто как ???
	$objResponse->append("cboxLoadedContent", "innerHTML", $text);
	//$objResponse->script("resize_cbox();");
	$objResponse->script("setTimeout('$.colorbox.resize()', 2)");
	$objResponse->call("setLocation", "?id_foto=$id");
	return $objResponse;
}
function gogoMail($values){
	$objResponse = new xajaxResponse();
	$type_form = $values['type_form'];
	if($type_form) $id_form = "mailed_popup_subscribe_news";
	else $id_form = "mailed";
	
	$values = mysql_real_escape_string($values['my_mail']);
	$mail = new fmakeMail();
	$all = $mail->getAll();
	$bool = false;
	foreach ($all as $key => $value) {
		if ($all[$key]['mail'] == $values){
			$script = '$("#'.$id_form.' label").text("Этот email уже есть в базе.");';
			$bool = true;
		}
	}
	if ($bool == false){
		$mail->addParam('mail', $values);
		$mail->newItem();
		$script = "setCookie('subscription_news_cookie','1',372);$('#popup_lenta .title,#popup_subscribe_news .title').hide();$('#popup_lenta .line,#popup_subscribe_news .line').html('<div class=\"title response\">Вы подписались на рассылку.</div>')";
	}
	$objResponse->script($script);
	return $objResponse;
}
function TapeWaveTab($val){
	$objResponse = new xajaxResponse();
	$fmakeComments = new fmakeComments();
	global $twig,$globalTemplateParam;
	$date = strtotime("today"/*,$tmp_date*/);
	$globalTemplateParam->set("to_day", $date);
	$news_obj = new fmakeSiteModule();
	$fmakeNews = new fmakeNews();
	$limit_news_lent = 13;
	$script = "$('#tape .verh').hide();";

	if ($val != '1' and $val != '2')
		$items_news_lent = $news_obj->getByPageAdmin(2, $limit_news_lent,1,"a.`file` = 'item_news'",true);
	else 
		$items_news_lent = $news_obj->getByPageAdmin(2, $limit_news_lent,1,"a.`file` = 'item_news' and b.main_cat = '{$val}'",true);

	if ($items_news_lent) foreach ($items_news_lent as $key=>$item) {
		$items_news_lent[$key]['comment'] = $fmakeComments->getByPageCount($item[$news_obj->idField],true);
		$fmakeNews->setId($items_news_lent[$key]['id']);
		$items_news_lent[$key]['mnenie'] = sizeof($fmakeNews->is_mnenie());
	}

	$globalTemplateParam->set('items_news_lent',$items_news_lent);
	if (sizeof($items_news_lent) < 13)
		$script.= "$('#tape .niz').hide();";
	else
		$script.= "$('#tape .niz').show();";
	$globalTemplateParam->set('news_obj', $news_obj);

	$text = $twig->loadTemplate("xajax/TapeWave_new_item.tpl")->render($globalTemplateParam->get()); 
	$objResponse->assign("x_tape", "innerHTML", $text);
	if ($val == '1')
		$val = 0;
	elseif ($val == '2')
		$val = 1;
	else
		$val = 2;
	$script.= "
		$('#tape .nav ul li.active').removeClass('active');
		$('#{$val}item_main').addClass('active');
		$('#tape .news').css({'margin-top': '0'});
		$('#is_tape').height($('#x_tape').height());
	";
	$objResponse->script($script);
	return $objResponse;
}

function TapeWave($lastID, $val){
	$objResponse = new xajaxResponse();
	$fmakeComments = new fmakeComments();
	global $twig,$globalTemplateParam;
	$script = "";
	$date = strtotime("today"/*,$tmp_date*/);
	$globalTemplateParam->set("to_day", $date);
	$news_obj = new fmakeSiteModule();
	$limit_news_lent = 3;
	if ($val == "0")
		$items_news_lent = $news_obj->getByPageAdmin(2, $limit_news_lent, 1,"a.`file` = 'item_news' and a.`id` < {$lastID} ",true);
	else 
		$items_news_lent = $news_obj->getByPageAdmin(2, $limit_news_lent, 1,"a.`file` = 'item_news' and a.`id` < {$lastID} and b.main_cat = '{$val}' ",true);
	$last = $items_news_lent['2']['id'];
	$fmakeNews = new fmakeNews();
	if ($items_news_lent) foreach ($items_news_lent as $key=>$item) {
		$items_news_lent[$key]['comment'] = $fmakeComments->getByPageCount($item[$news_obj->idField],true);
		$fmakeNews->setId($items_news_lent[$key]['id']);
		$items_news_lent[$key]['mnenie'] = sizeof($fmakeNews->is_mnenie());
	}
	if ($items_news_lent < 3)
		$script .= "$('#tape .niz').hide();";
	$globalTemplateParam->set('items_news_lent',$items_news_lent);
	$globalTemplateParam->set('news_obj', $news_obj);
	$text = $twig->loadTemplate("xajax/TapeWave.tpl")->render($globalTemplateParam->get());
	$objResponse->assign("last_id", "innerHTML", $last);
	$objResponse->append("x_tape", "innerHTML", $text);
	$script .= "newstape(); $('.pre').hide();";
	$script .= "$('#tape .news').css( { 'margin-top': parseInt($('#is_tape').height()) - parseInt($('#x_tape').height()) - 2 });";
	$objResponse->script($script);
	return $objResponse;
}
function SiteCount($id){
	$objResponse = new xajaxResponse();
	$count = new fmakeCount();
	$count->soCounted($id);
	
	$fmakeBanerContent = new fmakeBanerContent();
	$fmakeBanerContent->updateUseViewPage($id);
	$fmakeBanerContent->updateUsePricePage($id,'view');
	
	return $objResponse;
}
function viewBaner($id) {
	$objResponse = new xajaxResponse();
	$fmakeBanerContent = new fmakeBanerContent();
	$fmakeBanerContent->updateUseView($id);
	$fmakeBanerContent->updateUsePrice($id,'view');
    return $objResponse;
}

function clickBaner($id) {
	$objResponse = new xajaxResponse();
	$fmakeBanerContent = new fmakeBanerContent();
	$fmakeBanerContent->updateUseClick($id);
	$fmakeBanerContent->updateUsePrice($id,'click');
    return $objResponse;
}

function addStar($id_content,$rating){
	$objResponse = new xajaxResponse();
	
	$fmakeRating = new fmakeRating();
	$item = $fmakeRating->getRating($id_content);
	if($item){
		$is_active = $fmakeRating->isRatingCookie($id_content);
		if(!$is_active){
			$fmakeRating->addRatingCookie($id_content);
			
			$new_rating = ((floatval($item['rating'])*intval($item['count'])+$rating)/(intval($item['count'])+1));
			$fmakeRating->setId($id_content);
			$fmakeRating->addParam("rating", round($new_rating,3));
			$fmakeRating->addParam("count", intval($item['count'])+1);
			$fmakeRating->update();
		}	
		
		
	}
	else{
		$fmakeRating->addRatingCookie($id_content);
		$item['rating'] = 0;
		$item['count'] = 0;
		
		$new_rating = ((floatval($item['rating'])*$item['count']+$rating)/($item['count']+1));
		//$objResponse->alert($new_rating);
		$fmakeRating->addParam("id",$id_content);
		$fmakeRating->addParam("rating", round($new_rating,3));
		$fmakeRating->addParam("count", $item['count']+1);
		$fmakeRating->newItem();
		
	}
	
	$item = $fmakeRating->getRating($id_content);
	$item[rating] = round($item[rating]);
	
	$str_active = 1;
	
	$str_star_update = "<div class=\"stars\" disabled-star=\"{$str_active}\" problem-id=\"{$id_content}\" problem-rating=\"{$item[rating]}\" id=\"stars{$id_content}\"></div>";
	
	$script = "$(function(){	
					$('#stars{$id_content}').ratings(5,{$item[rating]},{$str_active}).bind('ratingchanged', function(event, data) {
						addStarRating({$id_content},data.rating);
					});
				});";
	
	$objResponse->assign("div-stars-update{$id_problem}","innerHTML", $str_star_update);
	$objResponse->script($script);
	
	return $objResponse;
}

function sendLetter($email, $msg) {
	$configs = new globalConfigs();

	$msg = trim(nl2br($msg));

	$mail = new PHPMailer();
	$mail->CharSet = "utf-8";//кодировка
	$mail->From = 'support@engels.bz';
	$mail->FromName = 'SUPPORT';
	$mail->AddAddress($configs->email);
	$mail->SetLanguage("ru");
	$mail->isHTML(true);
	$mail->Subject = "Сообщение с сайта engels.bz";
	$mail->Body = "<b>E-mail:</b>{$email}<br/><b>Сообщение :</b>{$msg}";
	$mail->Send();
	
    return true;
}
function moreComments($id_content,$limit,$page) {
	
	$fmakeComments = new fmakeComments();
	$comments = $fmakeComments->getByPage($id_content,$limit,$page,true);
	
	if ($comments) foreach($comments as $key=>$item) {
		$fmakeSiteUser = new fmakeSiteUser();
		$fmakeSiteUser->setId($item['id_user']);
		$user_params = $fmakeSiteUser->getInfo();
		$comments[$key]['user_params'] = $user_params;
		$comments[$key]['text'] = stripslashes($item['text']);
	}
	
	$count = $fmakeComments->getByPageCount($id_content,true);
	$pages = ceil($count/$limit);
	
	global $twig,$globalTemplateParam;
	$globalTemplateParam->set('comments',$comments);
	$text = $twig->loadTemplate("comments/xajax_add_items.tpl")->render($globalTemplateParam->get());
	$objResponse = new xajaxResponse();
	$objResponse->append("comments","innerHTML", $text);
	if($pages>$page){
		$page = $page+1;
		$objResponse->assign("more_comments", "innerHTML", "<a onclick=\"$('#preloader_comment').show();xajax_moreComments({$id_content},{$limit},{$page});return false;\" href=\"javascript: return false;\">Еще комментарии</a>");
		$objResponse->script("$('#preloader_comment').hide();");
	}
	else{
		$objResponse->assign("block_more_comments", "innerHTML", "");
	}
	return $objResponse;
}

function getMeetsMain($time){
	$meets_obj = new fmakeMeets();
	$limit_meets = 6;
	
	$date_array = $meets_obj->dateFilter(date('d.m.Y',$time));
	$date_to = $date_array["to"];
	/*отминмаем одну милисекунду чтобы использовать <= к правой границе даты*/
	$date_from = $date_array["from"]-1;
	
	$filter_date = "( ( ( '{$date_to}'<= b.date AND b.date <= '{$date_from}') OR ( '{$date_to}'<= b.date_from AND b.date_from <= '{$date_from}' ) ) OR 
				              ( b.date <= '{$date_to}' AND '{$date_from}' <= b.date_from ) )";
	
	$meets_obj->order = "RAND()";
	$items_meets_main = $meets_obj->getByPageAdmin(4, false,false,"a.`file` = 'item_meets' and {$filter_date} ",true);
	$items_meets_main = $meets_obj->uniqParent($items_meets_main,$limit_meets);
	global $twig,$globalTemplateParam;
	$globalTemplateParam->set('items_meets_main',$items_meets_main);
	$globalTemplateParam->set('meets_obj',$meets_obj);
	$text = $twig->loadTemplate("meets/meets_main.tpl")->render($globalTemplateParam->get());
	
	$date = date('d.m.Y',$time);
	//$link_afiwa_more = "<a href=\"{$meets_obj->getLinkPage(4)}?filter[action]=search&filter[check]=true&filter[event_date]={$date}\">Посмотреть все события</a>";
	
	$objResponse = new xajaxResponse();
	$objResponse->assign("foto-menu","innerHTML", $text);
	//$objResponse->assign("afiwa_more","innerHTML", $link_afiwa_more);
	$objResponse->script("$('#preloader_meets').hide();");
	return $objResponse;
}
#########################
function getMainVote($params){
	$objResponse = new xajaxResponse();
	global $twig,$globalTemplateParam;

	$modul = new fmakeSiteModule();
	$globalTemplateParam->set('site_obj',$modul);
	$fmakeInterview = new fmakeInterview();
	$interview = $fmakeInterview->getInterview(3); 

	if($params['action'] == 'interview_right' && $params['interview_id']){
		$error['interview'] = "";
		if(!$params['response']) $error['interview']['response'] = "Отметьте хотя бы 1 вариант";
		if(!$error['interview']){
			$_fmakeInterview = new fmakeInterview();
			$_fmakeInterview->table = $_fmakeInterview->table_vopros;
			$_fmakeInterview->setId($params['response']);
			$interview_item = $_fmakeInterview->getInfo(); 
			$_fmakeInterview->addParam('stat', intval($interview_item['stat'])+1);
			$_fmakeInterview->update();
			setcookie("interview".$params['interview_id'],1,time()+60*60*24*30,'/',$hostname);
			$iscookie_no_error = true;
			//$globalTemplateParam->set('iscookie',$iscookie);
		}else{
			$globalTemplateParam->set('error',$error); 
		}

		$iscookie = true;
		$vopros = array();
		$vopros_statistic = 0;
		#if ($interview) foreach ($interview as $key=>$interview_item) {
			
			$fmakeInterview->table = $fmakeInterview->table_vopros;
			$vopros = $fmakeInterview->getVoproses($params['interview_id'],true);
			if($vopros)foreach($vopros as $k=>$v){
				$vopros_statistic += $v['stat'];
			}
			#if($params['interview_id'] != $params['interview_id']) {
				//$iscookie = $fmakeInterview->isCookies($params['interview_id']);
			#} else {
				#if($iscookie_no_error) $iscookie[$key] = true;
				#else $iscookie[$key] = false;
			#}
		#}
		$globalTemplateParam->set('Quest',$vopros);
		$globalTemplateParam->set('Quest_stat',$vopros_statistic);
		$globalTemplateParam->set('interview_id',$params['interview_id']);
		#$globalTemplateParam->set('Cook',$iscookie);
		$globalTemplateParam->set('Cook',$iscookie);
		$inx = $params['interview_id'];
		$script = "getVote($inx);";
		$text = $twig->loadTemplate("xajax/vote_main.tpl")->render($globalTemplateParam->get());
		$objResponse->assign("QuestionFormRight".$params['interview_id'],"innerHTML", $text);	
		$objResponse->script($script);
	}
	
	return $objResponse;
}
#########################
/* написание функции */

$xajax->processRequest();
$globalTemplateParam->set('xajax', $xajax);