<?php

namespace SyntaxPhoenix\EJSParserBundle\Parser\Extension;

use DOMText;
use DOMElement;
use DOMDocument;
use Masterminds\HTML5;
use SyntaxPhoenix\EJSParserBundle\Parser\EditorjsParserExtension;

class HeaderParser extends EditorjsParserExtension
{

    public function parseBlock(HTML5 $html5, DOMDocument $document, object $block, string $prefix): DOMElement
    {     
        $text = new DOMText($block->data->text);

        $header = $document->createElement('h' . $block->data->level);

        $header->setAttribute('class', "{$prefix}-h{$block->data->level}");

        $header->appendChild($text);

        return $header;
    }
}
