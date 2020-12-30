<?php


namespace App\Helpers;


use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class LineMessageResponseHelper
{

    public $httpHost;
    public $bot;

    public function __construct()
    {
        $this->httpHost = new CurlHTTPClient(env('LINE_BOT_CHANNEL_ACCESS_TOKEN'));
        $this->bot = new LINEBot($this->httpHost, ['channelSecret' => env('LINE_BOT_CHANNEL_SECRET')]);
    }

    public function bot()
    {
        return $this->bot;
    }


}
