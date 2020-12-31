<?php


namespace App\Helpers;

use LINE\LINEBot\Constant\Flex\ComponentPosition;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\FillerComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ContainerBuilder\CarouselContainerBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\Uri\AltUriBuilder;
use LINE\LINEBot\Constant\Flex\ComponentButtonHeight;
use LINE\LINEBot\Constant\Flex\ComponentButtonStyle;
use LINE\LINEBot\Constant\Flex\ComponentFontSize;
use LINE\LINEBot\Constant\Flex\ComponentFontWeight;
use LINE\LINEBot\Constant\Flex\ComponentIconSize;
use LINE\LINEBot\Constant\Flex\ComponentImageAspectMode;
use LINE\LINEBot\Constant\Flex\ComponentImageAspectRatio;
use LINE\LINEBot\Constant\Flex\ComponentImageSize;
use LINE\LINEBot\Constant\Flex\ComponentLayout;
use LINE\LINEBot\Constant\Flex\ComponentMargin;
use LINE\LINEBot\Constant\Flex\ComponentSpaceSize;
use LINE\LINEBot\Constant\Flex\ComponentSpacing;
use LINE\LINEBot\Constant\Flex\BubleContainerSize;
use LINE\LINEBot\MessageBuilder\FlexMessageBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\BoxComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\ButtonComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\IconComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\ImageComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\SeparatorComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\TextComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\SpanComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ContainerBuilder\BubbleContainerBuilder;


abstract class FlexMessageHelper
{

    protected static $data;

    abstract static function setMessage($data);
    abstract public function get();


    protected static function createBodyBlock($img, $title, $author, $link, $btnText = 'Read Article')
    {
        $image = ImageComponentBuilder::builder()
                ->setUrl($img ?? 'https://d2fltix0v2e0sb.cloudfront.net/dev-black.png')
                ->setSize(ComponentImageSize::FULL)
                ->setAspectRatio('2:3')
                ->setAspectMode(ComponentImageAspectMode::COVER);

        $text = BoxComponentBuilder::builder()
                ->setLayout(ComponentLayout::VERTICAL)
                ->setContents(
                    [
                        BoxComponentBuilder::builder()
                            ->setLayout('vertical')
                            ->setContents(
                                [
                                    TextComponentBuilder::builder()
                                        ->setSize(ComponentFontSize::MD)
                                        ->setColor('#ffffff')
                                        ->setWeight(ComponentFontWeight::BOLD)
                                        ->setText($title),
                                    TextComponentBuilder::builder()
                                        ->setSize(ComponentFontSize::SM)
                                        ->setColor('#ffffff')
                                        ->setStyle('italic')
                                        ->setWeight(ComponentFontWeight::REGULAR)
                                        ->setText('by '. $author)
                                ]
                            )
                    ]
                );

        $readButton = BoxComponentBuilder::builder()
                    ->setLayout(ComponentLayout::VERTICAL)
                    ->setContents(
                        [
                           FillerComponentBuilder::builder(),
                           BoxComponentBuilder::builder()
                                ->setLayout(ComponentLayout::BASELINE)
                                ->setContents(
                                    [
                                        FillerComponentBuilder::builder(),
                                        TextComponentBuilder::builder()
                                            ->setText($btnText)
                                            ->setColor('#ffffff')
                                            ->setFlex(0)
                                            ->setOffsetTop('-2px'),
                                        FillerComponentBuilder::builder()
                                    ]
                                )
                                ->setSpacing(ComponentSpacing::SM),
                           FillerComponentBuilder::builder()
                        ]
                    )
                    ->setCornerRadius('4px')
                    ->setBorderWidth('1px')
                    ->setSpacing(ComponentSpacing::SM)
                    ->setBorderColor('#ffffff')
                    ->setMargin(ComponentMargin::XXL)
                    ->setHeight('40px')
                    ->setOffsetTop('10px')
                    ->setAction(
                        new UriTemplateActionBuilder(
                            null,
                            'https://dev.to' . $link,
                            new AltUriBuilder('https://dev.to'. $link )
                        )
                    );

        $container = BoxComponentBuilder::builder()
                    ->setLayout(ComponentLayout::VERTICAL)
                    ->setPosition(ComponentPosition::ABSOLUTE)
                    ->setBackgroundColor('#03303Acc')
                    ->setOffsetBottom('0px')
                    ->setOffsetStart('0px')
                    ->setOffsetEnd('0px')
                    ->setPaddingAll('20px')
                    ->setPaddingTop('18px')
                    ->setContents([
                        $text,
                        $readButton
                    ]);

        return BoxComponentBuilder::builder()
            ->setLayout(ComponentLayout::VERTICAL)
            ->setPaddingAll('0px')
            ->setContents(
                [
                    $image,
                    $container
                ]
            );
    }
}
