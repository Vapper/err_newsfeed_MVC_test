<?php

//include("FeedCache.php");
//$feed_cache = new FeedCache('rss_cache.xml', 'http://err.ee/rss');
//$data = simplexml_load_string($feed_cache->get_data());

$doc = new DOMDocument();
$validCache = false;
if (file_exists('cache/rss_cache_time.txt')) {
    $contents = file_get_contents('cache/rss_cache_time.txt');
    $data = unserialize($contents);
    if (time() - $data['created'] < 24 * 60 * 60) {
        $validCache = true;
        $doc->load('cache/cache.xml');
    }else{
        $validCache=false;
        $doc->load('http://err.ee/rss');
    }
}else{
    $doc->load('http://err.ee/rss');
}

if (!$validCache) {
    $data = array('created' => time());

    $dom = new DOMDocument;
    $dom->preserveWhiteSpace = TRUE;
    $dom->load('http://err.ee/rss');
    $dom->save('cache/cache.xml');

    file_put_contents('cache/rss_cache_time.txt', serialize($data));
}

?>