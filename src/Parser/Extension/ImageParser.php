<?php

namespace SyntaxPhoenix\EJSParserBundle\Parser\Extension;

use DOMElement;
use DOMDocument;
use Masterminds\HTML5;
use SyntaxPhoenix\EJSParserBundle\Parser\EditorjsParserExtension;

class ImageParser implements EditorjsParserExtension
{

    public function parseBlock(HTML5 $html5, DOMDocument $document, object $block, string $prefix): DOMElement
    {
        $figure = $document->createElement('figure');

        $imgAttrs = [
            "{$prefix}-image"
        ];

        if ($block->data->withBorder) {
            $imgAttrs[] = "{$prefix}-image-border";
        }
        if ($block->data->withBackground) {
            $imgAttrs[] = "{$prefix}-image-background";
        }
        if ($block->data->stretched) {
            $imgAttrs[] = "{$prefix}-image-stretched";
        }

        $figure->setAttribute('class', implode(' ', $imgAttrs));

        $img = $document->createElement('img');

        $img->setAttribute('src', $block->data->file->url);

        $figure->appendChild($img);

        if (!empty($block->data->caption)) {
            $figCaption = $document->createElement('figcaption');
            $figCaption->appendChild($html5->loadHTMLFragment($block->data->caption));

            $figure->appendChild($figCaption);
        }

        return $figure;
    }
}
