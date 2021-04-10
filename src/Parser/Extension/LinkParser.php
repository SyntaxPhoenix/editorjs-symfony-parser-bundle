<?php

namespace SyntaxPhoenix\EJSParserBundle\Parser\Extension;

use DOMText;
use DOMElement;
use DOMDocument;
use Masterminds\HTML5;
use SyntaxPhoenix\EJSParserBundle\Parser\EditorjsParserExtension;

class LinkParser extends EditorjsParserExtension
{

    public function parseBlock(HTML5 $html5, DOMDocument $document, object $block, string $prefix): DOMElement
    {
        $link = $document->createElement('a');

        $link->setAttribute('href', $block->data->link);
        $link->setAttribute('target', '_blank');
        $link->setAttribute('class', "{$prefix}-link");

        $innerContainer = $document->createElement('div');
        $innerContainer->setAttribute('class', "{$prefix}-link-container");

        $hasTitle = isset($block->data->meta->title);
        $hasDescription = isset($block->data->meta->description);
        $hasImage = isset($block->data->meta->image);

        if ($hasTitle) {
            $titleNode = $document->createElement('div');
            $titleNode->setAttribute('class', "{$prefix}-link-title");
            $titleText = new DOMText($block->data->meta->title);
            $titleNode->appendChild($titleText);
            $innerContainer->appendChild($titleNode);
        }

        if ($hasDescription) {
            $descriptionNode = $document->createElement('div');
            $descriptionNode->setAttribute('class', "{$prefix}-link-description");
            $descriptionText = new DOMText($block->data->meta->description);
            $descriptionNode->appendChild($descriptionText);
            $innerContainer->appendChild($descriptionNode);
        }

        $linkContainer = $document->createElement('div');
        $linkContainer->setAttribute('class', "{$prefix}-link-url");
        $linkText = new DOMText($block->data->link);
        $linkContainer->appendChild($linkText);
        $innerContainer->appendChild($linkContainer);

        $link->appendChild($innerContainer);

        if ($hasImage) {
            $imageContainer = $document->createElement('div');
            $imageContainer->setAttribute('class', "{$prefix}-link-img-container");
            $image = $document->createElement('img');
            $image->setAttribute('src', $block->data->meta->image->url);
            $imageContainer->appendChild($image);
            $link->appendChild($imageContainer);
            $innerContainer->setAttribute('class', "{$prefix}-link-container-with-img");
        }

        return $link;
    }
}
