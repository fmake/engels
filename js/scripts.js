$(document).ready(function(){
	$(".show_this_news").each(function(index){
		$(this).attr('id',index + 'show_this_news');
		$(this).hover(
			function(){
				$("#"+index+"load_content_news").show();
			},
			function(){
				$("#"+index+"load_content_news").hide();
			}
		);
	});
	var _b = false;
	$("#mest5").hover(
		function(){
			xajax_mainMeets();
		},
		function(){}
	);
	$("#mest5 , #mest5show").hover(
		function(){
			$("#mest5show").show();
		},
		function(){
			$("#mest5show").hide();
		}
	);
	$(".load_content_news").each(function(index){
		$(this).attr('id',index + 'load_content_news');
	});

    $('input.fieldfocus,textarea.fieldfocus').fieldFocus();
   
	$(".show").colorbox({
        rel:'show',
        //onLoad: function(){xajax_htmlforcolorbox($(this).attr('idrel'));}, 
        onComplete: function(){coms_ops();xajax_htmlforcolorbox($(this).attr('idrel')); setTimeout('$.colorbox.resize()', 100);setTimeout("$('input.fieldfocus,textarea.fieldfocus').fieldFocus();", 400)}, 
        onOpen: function(){onGoGo();},
        onClosed: function(){onEndEnd();removeLocation();},
        //html:"<p>Hello</p>",
    });

    /*фото форма*/
    $("#cboxLoadedContent img.cboxPhoto").live('click', function(){
    	$.colorbox.next();
    });
    $("#button_for_form_foto_for_comments").live('click', function(){
    	var __last = 0;
    	if($("#form_foto_for_comments .captcha").val() != ""){
    		$("#cboxLoadedContent #comments .last").each(function(index){
    			if (parseInt($(this).attr('name')) > __last)
    				__last = parseInt($(this).attr('name'));
    		});
    		xajax_formFoto(xajax.getFormValues('form_foto_for_comments'), $(this).attr('idfoto'), __last);
    		$("#form_foto_for_comments .error").html("");
    		if ($("#form_foto_for_comments .sucless").html() != ""){
    			$("#form_foto_for_comments .sucless").html("");
    		}
    		setTimeout('$.colorbox.resize()', 1);
    	}
    	else{
    		var __tt;
    		__tt = "Пожалуйста введите код с картинки. <br />";
    		$("#form_foto_for_comments .error").html(__tt);
    		setTimeout('$.colorbox.resize()', 1);
    	}
    });
    /*фото форма*/

	/*всплывающяя подписка на новости*/
	$('#current').live('click',function(){
		$('#current,#popup_subscribe_news').hide();
	});
	$(".close").live('click',function(){
		$("#current,#popup_subscribe_news").hide();
	});
	$("#mailed_popup_subscribe_news button").live("click", function(){
    	if (($("#my_mail_popup_subscribe_news").val() != "") && 
    	    		(!(!(($("#my_mail_popup_subscribe_news").val().indexOf(".")>0 ) && ($("#my_mail_popup_subscribe_news").val().indexOf("@") > 0 )) || /[^a-zA-Z0-9.@_-]/.test($("#my_mail_popup_subscribe_news").val()))))
    		xajax_gogoMail(xajax.getFormValues('mailed_popup_subscribe_news'));
    	else if ($("#my_mail_popup_subscribe_news").val() == "")
    		$("#mailed_popup_subscribe_news label").text("Не введен email");
    	else 
    		$("#mailed_popup_subscribe_news label").text("Не правильный email");
    });
	/*всплывающяя подписка на новости*/
	
    $("#mailed button").live("click", function(){
    	if (($("#my_mail").val() != "") && 
    	    		(!(!(($("#my_mail").val().indexOf(".")>0 ) && ($("#my_mail").val().indexOf("@") > 0 )) || /[^a-zA-Z0-9.@_-]/.test($("#my_mail").val()))))
    		xajax_gogoMail(xajax.getFormValues('mailed'));
    	else if ($("#my_mail").val() == "")
    		$("#mailed label").text("Не введен email");
    	else 
    		$("#mailed label").text("Не правильный email");
    });
    $('.icon-mail').live('click', function(e){
    	if($('#popup_lenta').css('display') == "none"){
    		$('#popup_lenta').show();
    		e.stopImmediatePropagation();
    	}
    	else
    	    $('#popup_lenta').hide();
    });
    $('#tape .nav ul li').each(function(index){
    	$(this).attr('id',index + 'item_main');
    });
    $('#popup_lenta').live('click', function(e){
    	e.stopImmediatePropagation();
    });
	$('#page').live('click', function(e){
		if ($('#popup_lenta').show())
			$('#popup_lenta').hide();
	});
	$('#show_all').hover(function(){
		var sh_width = 0;
		var total = 0;
		$('#show_all .hidden_show_all .item.laster').each(function(index){
			if (sh_width < $(this).width())
				sh_width = $(this).width();
		});
		$('#show_all .hidden_show_all .item.laster').each(function(index){
			$(this).width(sh_width);
		});	
		total+=sh_width;
		sh_width = 0;
		$('#show_all .hidden_show_all .item.nower').each(function(index){
			if (sh_width < $(this).width())
				sh_width = $(this).width();
		});
		total+=sh_width+30;
		$('#show_all .hidden_show_all .all_item').each(function(){
			$(this).width(total);
		});
		$('#show_all .hidden_show_all').width(total);
		$('#show_all .hidden_show_all .item.nower').each(function(index){
			$(this).width(sh_width);
		});	

	})
	$('.register .form input,.register .form select').hover(
		function(){
			var text_popup = $(this).attr('text_popup');
			if (text_popup) {
				$('#informer p').html(text_popup);
				$('#informer').css({'top':$(this).position().top+26}).show();
			}
		},
		function(){
			$('#informer').hide();
		}
	);
	
	$('.main-reklama li span').live('click',function(){
		if ($(this).attr('rel')=='active') {
			$(this).removeAttr('rel');
			$(this).next('ul').hide();
		} else {
			$(this).attr('rel','active');
			$(this).next('ul').show();
		}
	});
	
	$('#block_main .rb .inside .link a').on('hover',function(){
		$('#block_main .rb .inside .link a').removeClass('active');
		$('.newslist-content .tab-item').removeClass('active');
		$(this).addClass('active');
		var id_item = $(this).attr('rel');
		$('.newslist-content #'+id_item).addClass('active');
	});
	
	$(".list-afiwa li").hover(
		function () {
			var rel = $(this).attr('rel');
			$(".list-afiwa li").removeClass("active");
			$(".image-block-afiwa li").hide();
			$(this).addClass("active");
			$("li."+rel+"").show();
		}, 
		function () {}
	);

	$(".menu_day .arrow.l").hide();
	$(".menu_day .arrow.r").on('click',function(){
		var margin_left = parseInt($("#spisok-items-week-date").css('margin-left'))-51;
		$("#spisok-items-week-date").css({'margin-left': margin_left+'px'});
		if(parseInt($("#spisok-items-week-date").css('margin-left'))<=-1387){
			$(".menu_day .arrow.r").hide();
			$(".menu_day .arrow.l").show();
		}else{ 
			$(".menu_day .arrow.r").show();
			$(".menu_day .arrow.l").show();
		}
		//alert(margin_left);
	});
	$(".menu_day .arrow.l").on('click',function(){
		var margin_left = parseInt($("#spisok-items-week-date").css('margin-left'))+51;
		$("#spisok-items-week-date").css({'margin-left': margin_left+'px'});
		if(parseInt($("#spisok-items-week-date").css('margin-left'))>=0){
			$(".menu_day .arrow.l").hide();
			$(".menu_day .arrow.r").show();
		}else{ 
			$(".menu_day .arrow.l").show();
			$(".menu_day .arrow.r").show();
		}
		//alert(margin_left);
	});
	
	$(".afisha-topic a").live('click',function(){
		$(".afisha-topic a").removeClass('active');
		$(this).addClass('active');
	});
	
	/*-----popup----*/
	$("#close_popup_likes a").live('click',function(){
		$("#current, #popup_likes").hide();
	});
	/*-----popup----*/
		
	//логин через соц сети
	$('#vkontakte').live('click',function(){
		var redirect_uri = window.location.href;
		//alert("http://oauth.vk.com/authorize?response_type=code&client_id=3112820&redirect_uri="+redirect_uri+"&scope=friends");
		document.location = "http://oauth.vk.com/authorize?response_type=code&client_id=3112820&redirect_uri="+redirect_uri+"";
	});
	$('#facebook').live('click',function(){
		var redirect_uri = window.location.href;
		document.location = "https://www.facebook.com/dialog/oauth?client_id=404043026331078&redirect_uri="+redirect_uri+"&response_type=code";
	});
	
	showInputs($('#parent select').val());
	
	
	$('.add_post_expert').live('click',function(){
		$(".form_add_post").toggle();
	});
	$('.add_sms_mailer').live('click',function(){
		$(".form_add_sms_mailer").toggle();
	});

	// Лента новостей Аякс

	$('#x_tape .pre_item').each(function(index){
		$(this).attr('id',index + 'x_tape_item');
	});

	$('#tape .niz').live('click', function(){
		if (parseInt($('#tape .news').css('margin-top')) <= parseInt($('#is_tape').height()) - parseInt($('#x_tape').height()) ){
			$(".pre").show();
			xajax_TapeWave($('#last_id').html(), $('#tape .nav ul li.active').attr('rel'));
			$("#tape .verh").show();
		}
		else{	
			var height = 0;
			for (var i = 1; i < 4; i++) {
				height = parseInt(height) + $(('#'+ parseInt($('.pre_item:last').attr('id'))) + 'x_tape_item').height();
			};
			$('#tape .news').css({'margin-top': parseInt($('#tape .news').css('margin-top')) - height});
		}
		if (parseInt($('#tape .news').css('margin-top')) < 0){
			$("#tape .verh").show();
		};
	});
	
	$("#tape .verh").hide();

	$("#tape .verh").live('click', function(){
		var height = 0;
		var start_element = parseInt($('.pre_item:last').attr('id'));
		for (var i = 1; i < 4; i++) {
			height = parseInt(height) + parseInt($('#' + start_element +'x_tape_item').height());
		}
		$('#tape .news').css({'margin-top': parseInt($('#tape .news').css('margin-top')) + height});
		if (parseInt($('#tape .news').css('margin-top')) >= 0){
			$("#tape .verh").hide();
			$('#tape .news').css({'margin-top': '0'});
		};
	});
	$('#is_tape').height($('#x_tape').height());
	// Конец аякса ленты новостей 

	/*answer*/
	$('.expert_answer').live('click',function(){
		$(this).next('.answer_expert').toggle();
		//$(this).next('.answer_expert').show();
	});
	/*answer*/
	/*кнопка еще */
	idcatlist = 0;
	$(".catlist, .afisha-topic").each(function(index) {
	    //alert(index + ': ' + $(this).text());
		maxWidth = parseFloat($(this).css('width')) - 70;
		//alert(maxWidth);
		curWidth = 0;
		isOther = false;
		var elements = [];
		
		$(this).find("*").each(function(index) {
			//alert(index + ': width: ' + parseFloat($(this).css('width'))+ ' padding-left: ' + $(this).css('padding-left')+ ' padding-right: ' + $(this).css('padding-right')+ ' margin-left: ' + $(this).css('margin-left')+ ' margin-right: ' + $(this).css('margin-right'));
			width =  parseFloat($(this).css('width'))
					+parseFloat($(this).css('padding-left')) + parseFloat($(this).css('padding-right'))
					+parseFloat($(this).css('margin-left')) + parseFloat($(this).css('margin-right'));
			//alert(width);
			curWidth += width;
			if(curWidth > maxWidth){
				if($(this).get(0).tagName == 'A'){
					$(this).attr('class','') ;
					elements.push( $(this).clone() );
				}
				$(this).remove();
				isOther = true;
			}
		});
		if(isOther){
			$(this).append('<a href="#" onclick="$(\'#other-'+idcatlist+'\').show();return false;">Еще</a>');
			div = $("<div class='other' id='other-"+idcatlist+"' ></div>");
			for(var i = 0; i < elements.length;i++){
				$(div).append($(elements[i])).append('<br/>');
			}
			$(this).append($(div));
		}
		idcatlist++;
	}); 
	/*голосования*/
	$('.vote').each(function(index){
		$(this).attr('id', 'vote-item'+index);
		var wdt = 0;
		$('#vote-item'+index+' .var .color').each(function(index2){
			$(this).attr('class','color color-var-item'+index2);
			wdt += parseInt($(this).attr('wdt'));
		})
		$('#vote-item'+index+' .var .number').each(function(index4){
			$(this).attr('class', 'number item-nubmer'+index4);
		});
		$('#vote-item'+index+' .var .value').each(function(index3) {
			var total;
			var color;
			total = parseInt($('.var').width()) - 20 - parseInt($(this).width());
			total = 1/(wdt/parseInt($('#vote-item'+index+' .color-var-item'+index3).attr('wdt'))) * total;
			color = 1/(wdt/parseInt($('#vote-item'+index+' .color-var-item'+index3).attr('wdt')));
			$('#vote-item'+index+' .color-var-item'+index3).css({'background': '#6438c8'});
			if (color > 0.10)
				$('#vote-item'+index+' .color-var-item'+index3).css({'background':'#68a332'});
			if (color > 0.25)
				$('#vote-item'+index+' .color-var-item'+index3).css({'background':'#0d44a0'});	
			if (color > 0.50)
				$('#vote-item'+index+' .color-var-item'+index3).css({'background': '#ff0000'});
			$('#vote-item'+index+' .item-nubmer'+index3).html(Math.round(color*100)+"%"); 
			$('#vote-item'+index+' .color-var-item'+index3).width(total);
		});
	});

	var index_but;
	$('.vote .hide_me').each(function(index){
			$(this).addClass("hide_me-item" + index)
			$(this).hide();	
			index_but = index;
	});
	$('.vote .hide_me.hide_me-item'+index_but).show(); 

	/*голосования*/
	$('.answer_comment').each(function(index){
		$(this).attr('id', 'answer_comment_item'+index);
	});
	$('#lenta .i_am_alone').click(function(){
		if($("#lenta .list").css('display') == "none"){
			$("#lenta .list").css({'display':'block'});
			$("#lenta").css({'width':'204px'});
			$(".page-container").css({'margin-left':'214px'});
			$("#lenta .i_am_alone").css({'background':'url("/images/bg/alone_2.png") no-repeat 6px 48%'});
		}else{
			$(".page-container").css({'margin-left':'40px'});
			$("#lenta").css({'width':'25px'});
			$("#lenta .list").css({'display':'none'});
			$("#lenta .i_am_alone").css({'background':'url("/images/bg/alone.png") no-repeat 3px 48%'});
		}
	});
	$(window).resize(function(){
		var w = $(window).width();
		if(w > 1210) {
			$('#lenta .i_am_alone').css({'display':'none'});
			$("#lenta .list").css({'display':'block'});
			$("#lenta").css({'width':'204px'});
			$(".page-container").css({'margin-left':'214px'});
			$("#lenta .i_am_alone").css({'background':'url("/images/bg/alone_2.png") no-repeat 6px 48%'});
		}else{
			$("#lenta .i_am_alone").css({'display':'block'});
			$(".page-container").css({'margin-left':'40px'});
			$("#lenta").css({'width':'25px'});
			$("#lenta .list").css({'display':'none'});
			$("#lenta .i_am_alone").css({'background':'url("/images/bg/alone.png") no-repeat 3px 48%'});
		}
	});
});
function resize_cbox(){
	var __wc,
		__owc;
	__owc = $("#cboxLoadedContent").height();
	__wc = $("#cboxLoadedContent").height();
	__owc = parseInt($("#cboxWrapper").height()) - parseInt(__owc);
	$("#cboxLoadedContent").height("auto");
	$("#cboxContent").height(parseInt(__wc));
	$("#cboxMiddleLeft").height(parseInt(__wc));
	$("#cboxMiddleRight").height(parseInt(__wc));
	$("#colorbox").height(parseInt(__wc));
	$("#cboxWrapper").height("auto");
}
function coms_ops(){
	$("#cboxContent").css({'overflow':'none'});
	$("#cboxClose, #cboxNext, #cboxCurrent, #cboxPrevious, #cboxTitle").css({'bottom': '100%', 'top':'1px'})
	$("#cboxLoadedContent").css({'margin-top': '20px', 'margin-bottom': '0px'})
	$.colorbox.resize();
}
function onGoGo(){
	$("#all_content_for_noscroll").css({'position':'fixed','width':'100%'});
}
function onEndEnd(){
	$("#all_content_for_noscroll").css({'position':'static','width':'auto'});	
}
function getVote(inx){
	var wdt = 0;
	$('#QuestionFormRight'+inx+' .var .color').each(function(index2){
		$(this).attr('class','color color-var-item'+index2);
		wdt += parseInt($(this).attr('wdt'));
	})
	$('#QuestionFormRight'+inx+' .var .number').each(function(index4){
		$(this).attr('class', 'number item-nubmer'+index4);
	});
	$('#QuestionFormRight'+inx+' .var .value').each(function(index3) {
		var total;
		var color;
		total = parseInt($('.var').width()) - 20 - parseInt($(this).width());
		total = 1/(wdt/parseInt($('#QuestionFormRight'+inx+' .color-var-item'+index3).attr('wdt'))) * total;
		color = 1/(wdt/parseInt($('#QuestionFormRight'+inx+' .color-var-item'+index3).attr('wdt')));
		$('#QuestionFormRight'+inx+' .color-var-item'+index3).css({'background': '#6438c8'});
		if (color > 0.10)
			$('#QuestionFormRight'+inx+' .color-var-item'+index3).css({'background':'#68a332'});
		if (color > 0.25)
			$('#QuestionFormRight'+inx+' .color-var-item'+index3).css({'background':'#0d44a0'});	
		if (color > 0.50)
			$('#QuestionFormRight'+inx+' .color-var-item'+index3).css({'background': '#ff0000'});
		$('#QuestionFormRight'+inx+' .item-nubmer'+index3).html(Math.round(color*100)+"%"); 
		$('#QuestionFormRight'+inx+' .color-var-item'+index3).width(1);
		$('#QuestionFormRight'+inx+' .color-var-item'+index3).animate({width: total}, "show");
	});
}
function SubmitFormVote(id){
	$('#QuestionFormRight'+id+' img').show();
	$('.vote .hide_me').hide();
	xajax_getMainVote(xajax.getFormValues('QuestionFormRight'+id));
}
/*места*/
function showInputsParams(array_all,array){
	try{
		var str = "parent,caption,addres,date_work,phone,email,web,wifi,bron_cherez_engels,text";
		for(i=0;i<array_all.length;i++){
			$("#"+array_all[i]).hide();
		}
		for(i=0;i<array.length;i++){
			$("#"+array[i]).show();
			str +=","+array[i];
		}
		document.getElementById("filds").value=str;
	}catch(e){
		return true;
	}
}
function newstape(){
	$('#x_tape .pre_item').each(function(index){
		$(this).attr('id',index + 'x_tape_item');
	});
}
function showInputs(id){
	try{
		/*'caption','addres','date_work','phone','email','web','wifi','bron_cherez_engels','kitchen','average_chek','business_lunch','banket','more_services','capacity','steam','pool','restroom','music','residents','num_dance_flors','num_track','type_billiards','num_tables'*/
		var array_all = ['kitchen','average_chek','business_lunch','banket','more_services','capacity','steam','pool','restroom','music','residents','num_dance_flors','num_track','type_billiards','num_tables'];
		//alert(id);
		switch(id){
			case '209'://рестораны
				//var array = ['kitchen','average_chek','business_lunch','banket','more_services'];
				//break;
			case '210'://кафе
				//var array = ['kitchen','average_chek','business_lunch','banket','more_services'];
				//break;
			case '211'://бары
				var array = ['kitchen','average_chek','business_lunch','banket','more_services'];
				break;
			case '212'://парки
				var array = [];
				break;
			case '213'://музеи
				var array = [];
				break;
			case '251'://отели и гостиницы
				var array = [];
				break;
			case '258'://клубы
				var array = ['kitchen','music','residents','num_dance_flors','more_services'];
				break;
			default:
				var array = [];
				break;
		}
		showInputsParams(array_all,array);
	}catch(e){
		return true;
	}
}
/*места*/
function showhtml(text){
	__code = text;
}
function setCookie(name,value,time){
	$.cookie(name, value, { expires: time, path: '/'});
}

function showCookie(){
	if(!$.cookie('like_cookie')){
		$('#current, #popup_likes').show();
		setCookie('like_cookie','1',2);
	}
}

function showPopup(){
	if(!$.cookie('like_cookie')){
		setTimeout("showCookie();", 10000);
	}
}

/*всплывающяя подписка на новости*/

function showNewsPopupCookie(){
	if(!$.cookie('popup_news_cookie')){
		
		if($('#popup_subscribe_news').css('display') == "none"){
    		$('#current,#popup_subscribe_news').show();
    	}
		
		setCookie('popup_news_cookie',1,7);
	}
}

function showNewsPopup(){
	if(!$.cookie('popup_news_cookie') && !$.cookie('subscription_news_cookie')){
		setTimeout("showNewsPopupCookie();", 10000);
	}
}

/*всплывающяя подписка на новости*/

function getMeetsMain(time,i){
	$("#preloader_meets").show();
	$("#spisok-items-week-date a").removeClass('active');
	$("#item-week-date"+i).addClass('active');
	xajax_getMeetsMain(time);
}

function getDate(obj){
    $("#select_date").html('<input type="text" name="filter[event_date]" value="" id="datepicker" style="width:200px;" />');
    $("#datepicker").datepicker();
    $("#datepicker").datepicker('show');
}
/*рейтинг*/
function addStarRating(id_content,rating){
	xajax_addStar(id_content,rating);
}
/*рейтинг*/

function changeStatusUser(val) {
	switch (val) {
		case 'ekspert':
			$('#oblast_ekspert,#first_name,#second_name,#main_email').show();
			break;
		default:
			$('#oblast_ekspert,#first_name,#second_name,#main_email').hide();
			break;
	}
}
function setLocation(curLoc){
  try {
    history.pushState(null, null, curLoc);
    return;
  } catch(e) {}
  location.hash = '#' + curLoc;
 }
 function removeLocation(){
 	try{
 		history.replaceState(null, null, "./");
 		return;
 	} catch(e){}
 }