<?php

namespace App\Markdown;

use League\CommonMark\Block\Element\Heading;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\HtmlRenderer;

class Converter
{
    public static function convert(string $markdown): string
    {
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addBlockRenderer(Heading::class, new HeadingRenderer());

        $parser = new DocParser($environment);
        $htmlRenderer = new HtmlRenderer($environment);

        $document = $parser->parse($markdown);

        return $htmlRenderer->renderBlock($document);
    }
}
