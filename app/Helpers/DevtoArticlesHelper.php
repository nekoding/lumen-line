<?php


namespace App\Helpers;


use LINE\LINEBot\MessageBuilder\Flex\ContainerBuilder\BubbleContainerBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ContainerBuilder\CarouselContainerBuilder;
use LINE\LINEBot\MessageBuilder\FlexMessageBuilder;

class DevtoArticlesHelper extends FlexMessageHelper
{

    public static function setMessage($data)
    {
        self::$data = $data;
        return new self;
    }

    /**
     * Create card
     *
     * @return \LINE\LINEBot\MessageBuilder\FlexMessageBuilder
     */
    public function get()
    {

        $articles = array();

        foreach (self::$data->result as $key => $value) {
            $articles[] = BubbleContainerBuilder::builder()->setBody(
                self::createBodyBlock(
                    $value->main_image,
                    $value->title,
                    $value->user->name,
                    $value->path
                )
            );
        }

        return FlexMessageBuilder::builder()
            ->setAltText('Articles')
            ->setContents(
                CarouselContainerBuilder::builder()
                    ->setContents($articles)
            );
    }
}
