<?php

namespace SyntaxPhoenix\EJSParserBundle\Parser\Extension;

use DOMElement;
use DOMDocument;
use Masterminds\HTML5;
use SyntaxPhoenix\EJSParserBundle\Parser\EditorjsParserExtension;

class ListParser extends EditorjsParserExtension
{

    public function parseBlock(HTML5 $html5, DOMDocument $document, object $block, string $prefix): DOMElement
    {
        $wrapper = $document->createElement('div');
        $wrapper->setAttribute('class', "{$prefix}-list");

        $list = null;

        switch ($block->data->style) {
            case 'ordered':
                $list = $document->createElement('ol');
                break;
            default:
                $list = $document->createElement('ul');
                break;
        }

        foreach ($block->data->items as $item) {
            $li = $document->createElement('li');
            $li->appendChild($html5->loadHTMLFragment($item));
            $list->appendChild($li);
        }

        $wrapper->appendChild($list);

        return $wrapper;
    }
}
