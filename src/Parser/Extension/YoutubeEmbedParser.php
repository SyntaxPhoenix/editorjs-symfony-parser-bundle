<?php

namespace SyntaxPhoenix\EJSParserBundle\Parser\Extension;

use DOMElement;
use DOMDocument;
use Masterminds\HTML5;
use SyntaxPhoenix\EJSParserBundle\Parser\EditorjsParserExtension;

class YoutubeEmbedParser implements EditorjsParserExtension
{

    public function parseBlock(HTML5 $html5, DOMDocument $document, object $block, string $prefix): DOMElement
    {
        $wrapper = $document->createElement('div');

        $wrapper->setAttribute('class', "{$prefix}-youtubeembed");

        $url = $block->data->url;
        if (strpos($url, 'watch?v=') !== false) {
            $url = str_replace('watch?v=', 'embed/', $url);
        }

        $attrs = [
            'src' => $url,
            'allow' => 'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture',
            'allowfullscreen' => true
        ];

        $wrapper->appendChild($this->createIframe($document, $attrs));

        return $wrapper;
    }

    private function createIframe(DOMDocument $document, array $attrs)
    {
        $iframe = $document->createElement('iframe');

        foreach ($attrs as $key => $attr) {
            $iframe->setAttribute($key, $attr);
        }

        return $iframe;
    }
}
