<?php
	
	echo "verkrijgRss is aangeroepen<br>";
	//Verkrijg de parameter q van de URL
	$q=$_GET["bron"];
	$max_aantal=$_GET["aantal"];

	//Controleer de waarde en zoek de bijbehorende nieuws-feed
	switch ($q) {
		case "bcrianto"		: $xml=("../xml/nieuws.rss");
							  break;
		case "badminton"	: $xml=("http://badmintoninfo.visualclubweb.nl/feed/news.aspx");
							  break;
		case "nbb"			: $xml=("http://www.badminton.nl/rss");
							  break;
		case "bwf"			: $xml=("http://www.bwfbadminton.org/feed/news.aspx?id=4");
							  break;
		default				: return;					  
	}

	$xmlDoc = new DOMDocument();
	$xmlDoc->load($xml);

	//Verkrijg info van het rss-info kanaal
	$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
	$channel_title = $channel->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
	$channel_link = $channel->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;

	//Geef informatie van het kanaal weer
	echo("<p><b><a style='color:white' href='" . $channel_link . "' target='_blanc'>" . $channel_title . "</a></b></p>");

	//Verkrijg informatie van alle nieuws-items
	$x=$xmlDoc->getElementsByTagName('item');
	if ($x->length < $max_aantal) {
		$max_aantal = $x->length;
	}
	for ($i=0; $i<$max_aantal; $i++) {
		//Verkrijg informatie van het huidige nieuws-item
		$item_title=$x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
		$item_link=$x->item($i)->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
		//Geef informatie van het kanaal weer met een link naar een nieuw tabblad
		if ($q=="bcrianto") {
			echo ("<p><a href='index.php?i=nieuws&item=" . $item_title . "'>" . $item_title . "</a>");
		} else {
			echo ("<p><a href='" . $item_link . "' target='_blanc'>" . $item_title . "</a>");
		}
		echo "</p>";//);
	}
?>