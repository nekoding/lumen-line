<?php


namespace App\Http\Traits;

use App\Helpers\RequestApiHelper as Api;

trait CommandHandler
{

    protected $defaultPage = 0;

    public function __call($method, $args)
    {
        return array(
            'status'   => false,
            'message' => 'Command not available'
        );
    }

    public function articles($params)
    {
        $page = $params ?? $this->defaultPage;

        $response = Api::get("https://dev.to/search/feed_content?per_page=5&page=$page&sort_by=published_at&sort_direction=desc&approved=&class_name=Article");

        return array(
            'status'    => true,
            'data'      => json_decode($response)
        );
    }

    public function podcasts($params)
    {
        $page = $params ?? $this->defaultPage;

        $response = Api::get("https://dev.to/api/podcast_episodes?per_page=5&page=$page");

        return array(
            'status'    => true,
            'data'      => json_decode($response)
        );
    }
}
