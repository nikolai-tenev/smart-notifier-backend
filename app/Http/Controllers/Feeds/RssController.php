<?php

namespace App\Http\Controllers\Feeds;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use SimpleXMLElement;

class RssController extends Controller
{
    public function getUpwork(string $queryString)
    {
        $client = new Client();

        $upworkRssResponse = $client->get("https://www.upwork.com/ab/feed/jobs/rss?$queryString");
        $jobsRss = new SimpleXMLElement($upworkRssResponse->getBody());

//        echo $jobsRss->channel->item->description;
//        echo "\n";
//        echo "\n";
//        echo "\n";
//        echo $jobsRss->channel->item->description->__toString();
//        echo "\n";
//        echo "\n";
//        echo "\n";
//        echo htmlspecialchars_decode($jobsRss->channel->item->description->__toString(), ENT_HTML5);
//        exit;

        $itemsArr = [];

        foreach ($jobsRss->channel->item as $item) {
            $title = html_entity_decode(html_entity_decode($item->title->__toString()));
            if (stripos($title, 'Do not apply') !== false) {
                continue;
            }

            $itemsArr[] = [
                'title' => $title,
                'link' => $item->link->__toString(),
                'description' => $item->description->__toString(),
                'publishedOn' => $item->pubDate->__toString()
            ];
        }

        return response()->json($itemsArr, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }
}