[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block center]]
	<script>
		{place_script|raw}
	</script>
    [[ include TEMPLATE_PATH ~ "breadcrumbs/main.tpl"]]

	<div id="item_news">
		<h1>{modul.caption}</h1>
		<div class="">
			<div class="nav">
				<ul>
					[[for cat in categories]]
						<li ><span><span><span><a onclick="showPlaces({cat.id},array_place);return false;" href="{cat.full_url}">{cat.caption}</a></span></span></span></li>
					[[endfor]]
				</ul>
			</div>
			<div class="cl"></div>
			<div class="filters">
				<form action="" method="post" id="search">
					<input type="text" id="query_google_map" name="query_google_map" value="{search_string}" title="Введите название" class="fieldfocus"/>
					<button onclick="searchPlaces(array_place);return false;" class="button" type="submit">
						<span class="button-left">
							<span class="button-right">
								<span class="button-text">
									<span>Найти</span>
								</span>
							</span>
						</span>
					</button>
				</form>
			</div>
			<div class="map-places">
				<script type="">
					ymaps.ready(initAllPlace);
				</script>
				<div id="map" style="width: 100%; height: 520px;"></div>
				<div class="preloader" id="preloader_google_maps"><center><img src="/images/pre.gif"></center></div>
			</div>
		</div>
	</div>
[[endblock]]

[[block right]]
	[[ include TEMPLATE_PATH ~ "places/right_block_baner.tpl"]]
[[endblock]]