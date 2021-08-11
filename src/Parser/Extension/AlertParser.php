<?php

namespace SyntaxPhoenix\EJSParserBundle\Parser\Extension;

use DOMText;
use DOMElement;
use DOMDocument;
use Masterminds\HTML5;
use SyntaxPhoenix\EJSParserBundle\Parser\EditorjsParserExtension;

class AlertParser implements EditorjsParserExtension
{

    public function parseBlock(HTML5 $html5, DOMDocument $document, object $block, string $prefix): DOMElement
    {
        $type = $block->data->type;
        $message = new DOMText($block->data->message);

        $wrapper = $document->createElement('div');
        $wrapper->setAttribute('class', "{$prefix}-alert {$prefix}-alert-{$type}");

        $textWrapper = $document->createElement('div');

        $textWrapper->appendChild($message);

        $wrapper->appendChild($textWrapper);

        return $wrapper;
    }
}
