[[set baner_right_7 = baner_obj.showBanerType(7,request_uri)]]
[[set baner_right_8 = baner_obj.showBanerType(8,request_uri)]]
[[set baner_right_9 = baner_obj.showBanerType(9,request_uri)]]
[[if baner_right_7 or baner_right_8 or baner_right_9]]
	<div id="right_news">
		/*БАНЕР new*/
			[[if baner_right_7]]
				<div>
					<br/>
					<p>
						{baner_right_7|raw}
					</p>
				</div>
			[[endif]]
		/*БАНЕР new*/
		/*БАНЕР new*/
			[[if baner_right_8]]
				<div>
					<br/>
					<p>
						{baner_right_8|raw}
					</p>
				</div>
			[[endif]]
		/*БАНЕР new*/
		/*БАНЕР new*/
			[[if baner_right_9]]
				<div>
					<br/>
					<p>
						{baner_right_9|raw}
					</p>
				</div>
			[[endif]]
		/*БАНЕР new*/
			<div class="cl"></div>
	<h1>Новости партнеров</h1>
		[[raw]]
		<!-- MarketGidComposite Start -->
		<div id="MarketGidScriptRootC41125">
		<div id="MarketGidPreloadC41125">
		</div>
		<script>
		(function(){
		var D=new Date(),d=document,b='body',ce='createElement',ac='appendChild',st='style',ds='display',n='none',gi='getElementById';
		var i=d[ce]('iframe');i[st][ds]=n;d[gi]("MarketGidScriptRootC41125")[ac](i);try{var iw=i.contentWindow.document;iw.open();iw.writeln("<html><body></body></html>");iw.close();var c=iw[b];}
		catch(e){var iw=d;var c=d[gi]("MarketGidScriptRootC41125");}var dv=iw[ce]('div');dv.id="MG_ID";dv[st][ds]=n;dv.innerHTML=41125;c[ac](dv);
		var s=iw[ce]('script');s.async='async';s.defer='defer';s.charset='utf-8';s.src="http://jsc.dt00.net/e/n/engels.bz.41125.js?t="+D.getYear()+D.getMonth()+D.getDate()+D.getHours();c[ac](s);})();
		</script>
			<div class="cl"></div>
		</div>
		<!-- MarketGidComposite End -->
		[[endraw]]
	<div class="cl"></div>
		<div style="clear:both;"></div>
	</div>
[[else]]
	[[ include TEMPLATE_PATH ~ "news/right_block.tpl"]]
[[endif]]