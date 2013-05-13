<?xml version="1.0" encoding="utf-8" ?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
<atom:link href="http://{hostname}/news_rambler_rss.php" rel="self" type="application/rss+xml" />
<title>Новости Engels.bz</title>
<link>http://{hostname}</link>
<description>Энгельс bz - городской портал. Новости города, афиша, кафе, бары, рестораны, объявления, погода, фоторепортажи всех событий города.</description>
	[[for item in rssnews]]
		<item>
			<guid isPermaLink="true">http://{hostname}{item.full_url}</guid> 
			[[if item.picture]]<enclosure type="image/jpeg" length="{item.picture_length}" url="http://{hostname}/{news_obj.fileDirectory}{item.id}/406__{item.picture}" />[[endif]]
			<description>{item.description}</description>
			<link>http://{hostname}{item.full_url}</link>
			<pubDate>{df('date','r',item.date)}</pubDate>
			<title>{item.caption}</title>
			[[if item.autor]]<author>{item.autor}</author>[[endif]]
			<category>{item.name_category}</category>
		</item>
	[[endfor]]

</channel>
</rss>