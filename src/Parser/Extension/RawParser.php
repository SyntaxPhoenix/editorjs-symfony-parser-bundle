<?php

namespace SyntaxPhoenix\EJSParserBundle\Parser\Extension;

use DOMElement;
use DOMDocument;
use Masterminds\HTML5;
use SyntaxPhoenix\EJSParserBundle\Parser\EditorjsParserExtension;

class RawParser implements EditorjsParserExtension
{

    public function parseBlock(HTML5 $html5, DOMDocument $document, object $block, string $prefix): DOMElement
    {
        $wrapper = $document->createElement('div');

        $wrapper->setAttribute('class', "{$prefix}-raw");

        $wrapper->appendChild($html5->loadHTMLFragment($block->data->html));

        return $wrapper;
    }
}
