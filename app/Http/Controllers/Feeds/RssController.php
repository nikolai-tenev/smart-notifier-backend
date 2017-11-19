<?php

namespace App\Http\Controllers\Feeds;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use SimpleXMLElement;

class RssController extends Controller
{
    private function getParsedRssFeed(string $url): JsonResponse
    {
        $client = new Client();

        $rssResponse = $client->get($url);
        $jobsRss = new SimpleXMLElement($rssResponse->getBody());

        $itemsArr = [];

        foreach ($jobsRss->channel->item as $item) {
            $title = html_entity_decode(html_entity_decode($item->title->__toString()));
            if (stripos($title, 'Do not apply') !== false) {
                continue;
            }

            $title = str_ireplace(' - Upwork', '', $title);

            $itemsArr[] = [
                'guid' => $item->guid->__toString(),
                'title' => $title,
                'link' => $item->link->__toString(),
                'description' => $item->description->__toString(),
                'pubDate' => $item->pubDate->__toString()
            ];
        }

        return response()->json($itemsArr, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }

    public function getUpwork(string $queryString): JsonResponse
    {
        return $this->getParsedRssFeed("https://www.upwork.com/ab/feed/jobs/rss?$queryString");
    }

    public function getGuruCom(string $queryString): JsonResponse
    {
        return $this->getParsedRssFeed("https://www.guru.com/rss/jobs/$queryString");
    }
}