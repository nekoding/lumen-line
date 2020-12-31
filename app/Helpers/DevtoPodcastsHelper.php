<?php


namespace App\Helpers;


use LINE\LINEBot\MessageBuilder\Flex\ContainerBuilder\BubbleContainerBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ContainerBuilder\CarouselContainerBuilder;
use LINE\LINEBot\MessageBuilder\FlexMessageBuilder;

class DevtoPodcastsHelper extends FlexMessageHelper
{

    public static function setMessage($data)
    {
        self::$data = $data;
        return new self;
    }

    public function get()
    {
        $podcasts = array();

        foreach (self::$data as $podcast) {
            $podcasts[] = BubbleContainerBuilder::builder()->setBody(
                self::createBodyBlock(
                    $podcast->image_url,
                    $podcast->title,
                    $podcast->podcast->title,
                    $podcast->path,
                    'Open Podcasts'
                )
            );
        }

        return FlexMessageBuilder::builder()
            ->setAltText('Podcasts')
            ->setContents(
                CarouselContainerBuilder::builder()
                    ->setContents($podcasts)
            );
    }
}
