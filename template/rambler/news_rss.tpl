<?xml version="1.0" encoding="utf-8" ?>
<rss xmlns:rambler="http://news.rambler.ru" version="2.0">
<channel>
<title>Новости Engels.bz</title>
<link>http://{hostname}</link>
<description>Энгельс bz - городской портал. Новости города, афиша, кафе, бары, рестораны, объявления, погода, фоторепортажи всех событий города.</description>
	[[for item in rssnews]]
		<item>
			[[if item.picture]]<enclosure type="image/jpeg" length="{item.picture_length}" url="http://{hostname}/{news_obj.fileDirectory}{item.id}/406__{item.picture}" />[[endif]]
			<description>{item.description}</description>
			<link>http://{hostname}{item.full_url}</link>
			<pubDate>{df('date','r',item.date)}</pubDate>
			<title>{item.caption}</title>
			<fulltext><![CDATA[{item.text|raw}]]</fulltext>
			<author>{item.autor}</author>
			<category>{item.name_category}</category>
		</item>
	[[endfor]]

</channel>
</rss>