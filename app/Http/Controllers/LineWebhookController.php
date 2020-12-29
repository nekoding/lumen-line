<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class LineWebhookController extends Controller
{

    public function __invoke(Request $request)
    {
        $data = self::lineParse($request);

        $httpClient = new CurlHTTPClient(env('LINE_BOT_CHANNEL_ACCESS_TOKEN'));
        $bot = new LINEBot($httpClient, ['channelSecret' => env('LINE_BOT_CHANNEL_SECRET')]);

        $response = $bot->replyText($data->replyToken, 'hello');
        if ($response->isSucceeded()) {
            echo 'Succeeded!';
            return;
        }

    }

    protected static function lineParse(Request $request): object
    {
        $result = array();

        foreach ($request->events as $event)
        {
            foreach ($event as $key => $value) {
                $result[$key] = $value;
            }
        }

        return (object) $result;

    }
}
