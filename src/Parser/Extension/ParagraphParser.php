<?php

namespace SyntaxPhoenix\EJSParserBundle\Parser\Extension;

use DOMText;
use DOMElement;
use DOMDocument;
use Masterminds\HTML5;
use SyntaxPhoenix\EJSParserBundle\Parser\EditorjsParserExtension;

class ParagraphParser extends EditorjsParserExtension
{

    public function parseBlock(HTML5 $html5, DOMDocument $document, object $block, string $prefix): DOMElement
    {
        $node = $document->createElement('p');

        $node->setAttribute('class', "{$prefix}-paragraph");

        $node->appendChild($html5->loadHTMLFragment($block->data->text));

        return $node;
    }
}
