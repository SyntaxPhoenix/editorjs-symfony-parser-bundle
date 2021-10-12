<?php

namespace SyntaxPhoenix\EJSParserBundle\Parser\Extension;

use DOMElement;
use DOMDocument;
use Masterminds\HTML5;
use SyntaxPhoenix\EJSParserBundle\Parser\EditorjsParserExtension;

class TableParser implements EditorjsParserExtension
{

    public function parseBlock(HTML5 $html5, DOMDocument $document, object $block, string $prefix): DOMElement
    {
        $wrapper = $document->createElement('div');

        $wrapper->setAttribute('class', "{$prefix}-table");

        $table = $document->createElement('table');

        $tableBody = $document->createElement('tbody');

        foreach ($block->data->content as $row) {
            $tableRow = $document->createElement('tr');
            foreach ($row as $item) {
                $tableDefinition = $document->createElement('td');
                if (strlen($item) > 0) {
                    $tableDefinition->appendChild($html5->loadHTMLFragment($item));
                }
                $tableRow->appendChild($tableDefinition);
            }   
            $tableBody->appendChild($tableRow);
        }

        $table->appendChild($tableBody);

        $wrapper->appendChild($table);

        return $wrapper;
    }
}
