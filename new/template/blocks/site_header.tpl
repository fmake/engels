<div align="center" style="background: none repeat scroll 0 0 #FFFFFF;">
	
	/*БАНЕР new*/
		[[set baner_top_1 = baner_obj.showBanerType(1,request_uri)]]
		[[if baner_top_1]]
			<p class="floatright" style="height: 95px;">
				{baner_top_1|raw}
			</p>
		[[endif]]
	/*БАНЕР new*/
	
</div>
<div id="header">
		<div id="menu_top">
			<div class="page-container">
				<div id="version">
					<a href="#" class="active" style="cursor: default;">
						Полная версия
					</a>
				</div>
				<div id="time">
					{time_new|raw}
				</div>
				<div id="sky" onclick="location.href='#';">
					<span>За окном</span>
					<img src="/images/icons/sky_header.png" alt="Погода"/>
					<span class="temp"><a style="" href="{site_obj.getLinkPage(2325)}">{weather}</a></span>
				</div>
				<div id="money_rate">
					<span>Курс валют:</span>
					<img src="/images/icons/euro_header.png" alt="Евро"/>
					<a href="#"><span class="euro">{eur_valuta}</span></a>
					<img src="/images/icons/baks_header.png" alt="Доллар USA"/>
					<a href="#"><span class="baks">{usd_valuta}</span></a>
				</div>
				<div class="login">
					[[if user.id]]
						<div class="user_logined">
							<a href="{site_obj.getLinkPage(3817)}" class="l">Личный кабинет</a>[[if user_params.post_create]]<a href="/ya_mail.php?login={user_params.login}" target="_blank" class="l"> ( {user_params.message_new} )</a>[[endif]]
							<a href="?action=logout" class="a">Выйти</a>
						</div>
					[[else]]
						<button onclick="window.location.href = '{site_obj.getLinkPage(11)}';return false;">
							<span><span><span>Войти</span></span></span>
						</button>
						<button onclick="window.location.href = '{site_obj.getLinkPage(10)}';return false;">
							<span><span><span>Регистрация</span></span></span>
						</button>
					[[endif]]
				</div>
			</div>
		</div>
		<div class="cl"></div>
		<div id="menu_center">
			<div class="page-container">
				<div class="nav">
					[[ include TEMPLATE_PATH ~ "blocks/menu.tpl"]]
				</div>
				<div class="search">
					<div class="sh">
						<div class="b-s" onclick="$('#site_search').submit();"></div>
						<form action="/search/" method="get" id="site_search">
							<input type="text" name="q" class="fieldfocus" title="Поиск новостей"/>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div id="menu_down">
			<div class="page-container">
				[[if modul.index]]
					<img src="/images/logo/logo_header.png" alt="Логотип"/>
				[[else]]
					<a href="/"><img src="/images/logo/logo_header.png" alt="Логотип"/></a>
				[[endif]]
				<div class="mininews">
					<ul>
						[[for snew in short_news]]
							<li class="block_color{loop.index0}"><a href="{snew.full_url}" title="[[if snew.short_name]]{snew.short_name}[[else]]{snew.caption}[[endif]]">[[if snew.short_name]]{snew.short_name}[[else]]{snew.caption}[[endif]]</a></li>
						[[endfor]]
						/*<li class="block_purple"><a href="#">Нападение на худрука</a></li>
						<li class="block_blue"><a href="#">Зима в городе</a></li>
						<li class="block_red"><a href="#">Убийство деда Хасана</a></li>
						<li class="block_green"><a href="#">Купи билетик</a></li>
						<li class="block_grey"><a href="#">Комунисты</a></li>
						<li class="block_yellow"><a href="#">Телевизор</a></li>
						<li class="block_orange"><a href="#">Афиша</a></li>*/
					</ul>
				</div>
				<div class="warning_news">
					<div class="warning_text">
					[[if configs.anons_main_title]]
						[[if configs.anons_main_url]]
							<a href="{configs.anons_main_url}">{configs.anons_main_title}</a>
						[[else]]
							{configs.anons_main_title}
						[[endif]]
					[[else]]	
						<a href="/novosti-ot-chitatelej/">Обо всех важных и интересных событиях города круглосуточно сообщайте нам</a>
					[[endif]]
					</div>
				</div>
			</div>
			<div class="shadow">
					<div class="shadow_img"></div>
			</div>
		</div>
</div>