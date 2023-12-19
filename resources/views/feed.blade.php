<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0">
    <channel>
        <title>RSS Feed - Greater Republics and Nations of Lebanon and Armenia  </title>
        <link>https://www.national-armenia.org/rss-feed</link>
        <description>Lebanese Armenian Blog and Articles, political and social articles 
		for the great republics of Lebanon and Armenia</description>
        <language>en</language>
        <pubDate>{{ now()->toDayDateTimeString('Asia/Dhaka') }}</pubDate>

        @foreach($prods as $prod)
            <item>
                <title>{{ $prod->name }}</title>
                <link>{{ $prod->id }}</link>
                <description>{!! $prod->des !!}</description>
                <category>{{ $prod->cat['name'] }}</category>
                <author>Peter Manoukian</author>
                <guid>{{ $prod->id }}</guid>
                <pubDate>{{ $prod->created_at->toRssString() }}</pubDate>
            </item>
        @endforeach
    </channel>
</rss>