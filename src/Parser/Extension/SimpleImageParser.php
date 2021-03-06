<?php

namespace SyntaxPhoenix\EJSParserBundle\Parser\Extension;

use DOMElement;
use DOMDocument;
use Masterminds\HTML5;
use SyntaxPhoenix\EJSParserBundle\Parser\EditorjsParserExtension;

class SimpleImageParser implements EditorjsParserExtension
{

    public function parseBlock(HTML5 $html5, DOMDocument $document, object $block, string $prefix): DOMElement
    {
        $figure = $document->createElement('figure');

        $figure->setAttribute('class', "{$prefix}-simpleimage");

        $img = $document->createElement('img');

        $imgAttrs = [];

        if ($block->data->withBorder) {
            $imgAttrs[] = "{$prefix}-simpleimage-border";
        }
        if ($block->data->withBackground) {
            $imgAttrs[] = "{$prefix}-simpleimage-background";
        }
        if ($block->data->stretched) {
            $imgAttrs[] = "{$prefix}-simpleimage-stretched";
        }

        $img->setAttribute('src', $block->data->url);
        $img->setAttribute('class', implode(' ', $imgAttrs));

        $figCaption = $document->createElement('figcaption');

        $figCaption->appendChild($html5->loadHTMLFragment($block->data->caption));

        $figure->appendChild($img);

        $figure->appendChild($figCaption);

        return $figure;
    }
}
