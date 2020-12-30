<?php


namespace App\Http\Traits;

use App\Helpers\RequestApiHelper as Api;

trait CommandHandler
{

    protected $defaultPage = 0;

    public function __call($method, $args)
    {
        return 'command not found';
    }

    public function articles($params)
    {
        $page = $params ?? $this->defaultPage;

        $response = Api::get("https://dev.to/search/feed_content?per_page=5&page=$page&sort_by=published_at&sort_direction=desc&approved=&class_name=Article");

        return (string) $response;
    }

    public function podcasts($params)
    {
        $page = $params ?? $this->defaultPage;

        return $page;
    }

    public function tags($params)
    {
        if (is_null($params)) {
            return 'params cannot be null';
        }

        return $params;
    }
}
