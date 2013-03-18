<?xml version="1.0" encoding="utf-8" ?>
<rss version="2.0">
<channel>
<title>Новости Engels.bz</title>
<link>http://{hostname}/</link>
<description>Энгельс bz - городской портал. Новости города, афиша, кафе, бары, рестораны, объявления, погода, фоторепортажи всех событий города.</description>
<image>
<title>Новости Engels.bz</title>
<url>http://{hostname}/images/logo.png</url>
<link>http://elementy.ru/</link>
</image>
	[[for item in rssnews]]
		<item>
			[[if item.picture]]<enclosure type="image/jpeg" url="http://{hostname}/{news_obj.fileDirectory}{item.id}/100_80_{item.picture}"/>[[endif]]
			<description>{item.description}</description>
			<link>http://{hostname}{news_obj.getLinkPage(item.id)}</link>
			<pubDate>{df('date','r',item.date)}</pubDate>
			<title>{item.caption}</title>
		</item>
	[[endfor]]

</channel>
</rss>