<?php


namespace App\Http\Controllers;

use App\Helpers\FlexMessageHelper as FlexMessage;
use App\Http\Traits\CommandHandler;
use Illuminate\Http\Request;
use App\Helpers\LineMessageResponseHelper as Line;

class LineWebhookController extends Controller
{
    use CommandHandler;

    public function __invoke(Request $request)
    {
        $data = self::lineParse($request);
        $args = explode(' ', $data->message['text']);
        $command =  str_replace('/', '', $args[0]);
        $responseApi = $this->apply($command, $args[1] ?? null);

        if (!$responseApi['status']) {
            $bot = (new Line())->bot->replyText($data->replyToken, $responseApi['message']);

            if ($bot->isSucceeded()) {
                return 'success!';
            }
        }

        $message = FlexMessage::setMessage($responseApi['data'])->get();
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
