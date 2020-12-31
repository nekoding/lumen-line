<?php


namespace App\Http\Controllers;

use App\Helpers\DevtoArticlesHelper as Articles;
use App\Helpers\DevtoPodcastsHelper as Podcasts;
use App\Http\Traits\CommandHandler;
use Illuminate\Http\Request;
use App\Helpers\LineMessageResponseHelper as Line;
use Illuminate\Http\Response;

class LineWebhookController extends Controller
{
    use CommandHandler;

    public function __invoke(Request $request)
    {
        $data = self::lineParse($request);
        $args = explode(' ', $data->message['text']);
        $command =  preg_replace('/[^\da-z]/i', '', $args[0]);

        $responseApi = $this->apply($command, $args[1] ?? null);

        if (!$responseApi['status']) {
            $bot = (new Line())->bot->replyText($data->replyToken, $responseApi['message']);

            if ($bot->isSucceeded()) {
                return 'success!';
            }
        }

        switch ($command) {
            case 'articles':
                $message = Articles::setMessage($responseApi['data'])->get();
                break;
            case 'podcasts':
                $message = Podcasts::setMessage($responseApi['data'])->get();
                break;
            default:
                abort(Response::HTTP_BAD_REQUEST);
                break;
        }

        $bot = (new Line())->bot->replyMessage($data->replyToken, $message);

        if ($bot->isSucceeded()) {
            return 'success!';
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

    protected function apply($command, $params)
    {
        return call_user_func_array([$this, $command], [$params]);
    }
}
