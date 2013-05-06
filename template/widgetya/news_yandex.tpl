<?xml version="1.0" encoding="utf-8" ?>
<rss xmlns:yandex="http://news.yandex.ru" xmlns:media="http://search.yahoo.com/mrss/" version="2.0">
<channel>
<title>Новости Engels.bz</title>
<link>http://{hostname}</link>
<description>Энгельс bz - городской портал. Новости города, афиша, кафе, бары, рестораны, объявления, погода, фоторепортажи всех событий города.</description>
<image>
<title>Новости Engels.bz</title>
<url>http://{hostname}/images/logo/logo_header.png</url>
<link>http://{hostname}</link>
</image>
	[[for item in rssnews]]
		<item>
			[[if item.picture]]<enclosure type="image/jpeg" url="http://{hostname}/{news_obj.fileDirectory}{item.id}/406__{item.picture}" />[[endif]]
			<description>{item.description}</description>
			<link>http://{hostname}{item.full_url}</link>
			<pubDate>{df('date','r',item.date)}</pubDate>
			<title>{item.caption}</title>
			<yandex:full-text>{item.text|raw}</yandex:full-text>
			[[if item.autor]]<author>{item.autor}</author>[[endif]]
			<category>{item.name_category}</category>
		</item>
	[[endfor]]

</channel>
</rss>