<?php
//Convert JSONfeed to RSS in a single function as a drop-in to make adding JSONfeed
//support to an aggregator easier
function convert_jsonfeed_to_rss($content = NULL, $max = NULL)
{
    //Test if the content is actual JSON
    json_decode($content);
    if( json_last_error() !== JSON_ERROR_NONE) return FALSE;
    //Now, is it valid JSONFeed?
    $jsonFeed = json_decode($content, TRUE);
    if (!isset($jsonFeed['version'])) return FALSE;
    if (!isset($jsonFeed['title'])) return FALSE;
    if (!isset($jsonFeed['items'])) return FALSE;
    //Decode the feed to a PHP array
    $jf = json_decode($content, TRUE);
    //Get the latest item publish date to use as the channel pubDate
    $latestDate = 0;
    foreach ($jf['items'] as $item) {
        if (strtotime($item['date_published']) > $latestDate) $latestDate = strtotime($item['date_published']);
    }
    $lastBuildDate = date(DATE_RSS, $latestDate);
    //Create the RSS feed
    $xmlFeed = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><rss version="2.0"></rss>');
    $xmlFeed->addChild("channel");
    //Required elements
    $xmlFeed->channel->addChild("title", $jf['title']);
    $xmlFeed->channel->addChild("pubDate", $lastBuildDate);
    $xmlFeed->channel->addChild("lastBuildDate", $lastBuildDate);
    //Optional elements
    if (isset($jf['description'])) $xmlFeed->channel->description = $jf['description'];
    if (isset($jf['home_page_url'])) $xmlFeed->channel->link = $jf['home_page_url'];
    //Items
    foreach ($jf['items'] as $item) {
        $newItem = $xmlFeed->channel->addChild('item');
        //Standard stuff
        if (isset($item['id'])) $newItem->addChild('guid', $item['id']);
        if (isset($item['title'])) $newItem->addChild('title', $item['title']);
        if (isset($item['content_text'])) $newItem->addChild('description', $item['content_text']);
        if (isset($item['content_html'])) $newItem->addChild('description', $item['content_html']);
        if (isset($item['date_published'])) $newItem->addChild('pubDate', $item['date_published']);
        if (isset($item['url'])) $newItem->addChild('link', $item['url']);
        //Enclosures?
        if(isset($item['attachments'])) {
            foreach($item['attachments'] as $attachment) {
                $enclosure = $newItem->addChild('enclosure');
                $enclosure['url'] = $attachment['url'];
                $enclosure['type'] = $attachment['mime_type'];
                $enclosure['length'] = $attachment['size_in_bytes'];
            }
        }
    }
    //Improve appearance of output
    $dom = new DOMDocument("1.0");
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->loadXML($xmlFeed->asXML());
    return $dom->saveXML();
}