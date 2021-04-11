<?php

namespace SyntaxPhoenix\EJSParserBundle\Parser;

use StdClass;
use Exception;
use DOMDocument;
use Masterminds\HTML5;
use SyntaxPhoenix\EJSParserBundle\Parser\EditorjsParserExtension;
use SyntaxPhoenix\EJSParserBundle\Parser\Extension\CodeParser;
use SyntaxPhoenix\EJSParserBundle\Parser\Extension\DelimeterParser;
use SyntaxPhoenix\EJSParserBundle\Parser\Extension\EmbedParser;
use SyntaxPhoenix\EJSParserBundle\Parser\Extension\HeaderParser;
use SyntaxPhoenix\EJSParserBundle\Parser\Extension\ImageParser;
use SyntaxPhoenix\EJSParserBundle\Parser\Extension\LinkParser;
use SyntaxPhoenix\EJSParserBundle\Parser\Extension\ListParser;
use SyntaxPhoenix\EJSParserBundle\Parser\Extension\ParagraphParser;
use SyntaxPhoenix\EJSParserBundle\Parser\Extension\RawParser;
use SyntaxPhoenix\EJSParserBundle\Parser\Extension\WarningParser;

class EditorjsParser
{
    private StdClass $data;
    private DOMDocument $dom;
    private HTML5 $html5;
    private string $prefix = "prs";
    /** @var array<string, EditorjsParserExtension> */
    private array $parser = [];

    public function __construct(object $data)
    {
        $this->data = $data;

        $this->dom = new DOMDocument(1.0, 'UTF-8');

        $this->html5 = new HTML5([
            'target_document' => $this->dom,
            'disable_html_ns' => true
        ]);

        $this->parser = [
            'header' => new HeaderParser(),
            'delimeter' => new DelimeterParser(),
            'code' => new CodeParser(),
            'paragraph' => new ParagraphParser(),
            'link' => new LinkParser(),
            'embed' => new EmbedParser(),
            'raw' => new RawParser(),
            'list' => new ListParser(),
            'warning' => new WarningParser(),
            'simpleImage' => new ImageParser()
        ];
    }

    public function toHtml(): string
    {
        $this->render();

        return $this->dom->saveHTML();
    }

    private function hasBlocks()
    {
        return count($this->data->blocks) !== 0;
    }

    /**
     * @throws Exception
     */
    private function render(): void
    {
        if (!$this->hasBlocks()) {
            throw new Exception('No Blocks to parse !');
        }
        foreach ($this->data->blocks as $block) {
            if (in_array($block->type, $this->parser)) {
                $this->dom->appendChild(
                    $this->parser[$block->type]->parseBlock($this->html5, $this->dom, $block, $this->prefix)
                );
            }
        }
    }
    
}