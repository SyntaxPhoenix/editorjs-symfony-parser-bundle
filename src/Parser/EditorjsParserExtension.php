<?php

namespace SyntaxPhoenix\EJSParserBundle\Parser;

use DOMElement;
use DOMDocument;
use Masterminds\HTML5;

interface EditorjsParserExtension
{
    public function parseBlock(HTML5 $html5, DOMDocument $document, object $block, string $prefix): DOMElement;
}