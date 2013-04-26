<div style="clear: both;"></div>
<div class="form_news">
	<a name="comments"></a>
	<h1>Комментарии</h1>
	<a name="form_comments"></a>
	[[ include TEMPLATE_PATH ~ "xajax/comments/form.tpl"]]
</div>	
<div class="cl"></div>
<div class="all-c">
	[[if comments]]
		<div id="comments" class="all-c">
			[[for item in comments]]
				[[ include TEMPLATE_PATH ~ "xajax/comments/item.tpl"]]
			[[endfor]]
		</div>
		[[if is_more_link]]
			<div id="block_more_comments">
				<div class="preloader" id="preloader_comment"><center><img src="/images/preloader.gif"></center></div>
				<div id="more_comments">
					<a onclick="$('#preloader_comment').show();xajax_moreComments({include_param_id_comment},{limit_comment},2);return false;" href="javascript: return false;">Еще комментарии</a>
				</div>
			</div>
		[[endif]]
	[[endif]]	
</div>	
	
	/*
	[[raw]]
	<!-- Put this script tag to the <head> of your page -->
	<script type="text/javascript" src="//vk.com/js/api/openapi.js?75"></script>

	<script type="text/javascript">
	  VK.init({apiId: 3154353, onlyWidgets: true});
	</script>

	<!-- Put this div tag to the place, where the Comments block will be -->
	<div id="vk_comments"></div>
	<script type="text/javascript">
	VK.Widgets.Comments("vk_comments", {limit: 10, width: "740", attach: "*"});
	[[endraw]]
		[[if user.id == '105']] 
			[[raw]]
				VK.Observer.subscribe('widgets.comments.new_comment', function() {
					alert('qq');
				});
			[[endraw]]
		[[endif]]
	[[raw]]
	</script>
	[[endraw]]
	<br/>
	*/