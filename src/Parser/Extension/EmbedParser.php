<?php

namespace SyntaxPhoenix\EJSParserBundle\Parser\Extension;

use DOMElement;
use DOMDocument;
use Masterminds\HTML5;
use SyntaxPhoenix\EJSParserBundle\Parser\EditorjsParserExtension;

class EmbedParser implements EditorjsParserExtension
{

    public function parseBlock(HTML5 $html5, DOMDocument $document, object $block, string $prefix): DOMElement
    {
        $wrapper = $document->createElement('div');

        $wrapper->setAttribute('class', "{$prefix}-embed");

        switch ($block->data->service) {
            case 'youtube':

                $attrs = [
                    'height' => $block->data->height,
                    'src' => $block->data->embed,
                    'allow' => 'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture',
                    'allowfullscreen' => true
                ];

                $wrapper->appendChild($this->createIframe($document, $attrs));

                break;
            case 'codepen' || 'gfycat':

                $attrs = [
                    'height' => $block->data->height,
                    'src' => $block->data->embed,
                ];

                $wrapper->appendChild($this->createIframe($document, $attrs));

                break;
        }

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
