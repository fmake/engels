<div id="journal">
		<div class="shadow_img top"></div>
		<div class="page-container">
			<!--МЕСТА-->
			<div class="my_new_afish">
				<a href="{site_obj.getLinkPage(5)}" class="h1">
				    <h1>Места</h1>
				</a>
    			[[for item in items_place_main2]]
	    			[[if loop.index == 1]]
						<div class="img1">
							<a href="{item.full_url}"><img src="/{site_obj.isFile(item.id, 244, 249)}" alt="{item.title}" /></a>
							<div class="cl"></div>
							<div class="caption"><a href="{item.full_url}">{item.caption}</a></div>
						</div>
						<div class="img2">
							<div class="grid">
					[[else]]
							<div class="item_block [[if loop.index == 2 or loop.index == 5]]lt[[endif]]">
								<a href="{item.full_url}"><img src="/{site_obj.fileDirectory}{item.id}/140_100_{item.picture}" width="140" height="100" alt="{item.title}"/></a>
								<div class="cl"></div>
								<div class="caption"><a href="{item.full_url}">{item.caption}</a></div>
							</div>
						[[if loop.index == 4]]<div class="cl"></div>[[endif]]
					[[endif]]
				[[endfor]]
						<div class="cl"></div>
					</div>
				</div>
				<div class="ap">
					<!--РЕКЛАМА -->
					/*БАНЕР new*/
						[[set baner_mesta = baner_obj.showBanerType(7,'/mesta/')]]
						[[if baner_mesta]]
							<div>
								<p>
									{baner_mesta|raw}
								</p>
							</div>
						[[endif]]
					/*БАНЕР new*/
				</div>
				<div class="cl"></div>	
			</div>
			<!--МЕСТА-->
		</div>
		<div class="shadow">
			<div class="shadow_img"></div>
		</div>
	</div>