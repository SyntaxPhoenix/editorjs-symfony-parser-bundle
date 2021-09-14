<?php

namespace SyntaxPhoenix\EJSParserBundle\Parser;

use StdClass;
use Exception;
use DOMDocument;
use Masterminds\HTML5;
use SyntaxPhoenix\EJSParserBundle\Exception\NoBlockException;
use SyntaxPhoenix\EJSParserBundle\Parser\Extension\RawParser;
use SyntaxPhoenix\EJSParserBundle\Parser\Extension\CodeParser;
use SyntaxPhoenix\EJSParserBundle\Parser\Extension\LinkParser;
use SyntaxPhoenix\EJSParserBundle\Parser\Extension\ListParser;
use SyntaxPhoenix\EJSParserBundle\Parser\Extension\AlertParser;
use SyntaxPhoenix\EJSParserBundle\Parser\Extension\EmbedParser;
use SyntaxPhoenix\EJSParserBundle\Parser\Extension\ImageParser;
use SyntaxPhoenix\EJSParserBundle\Parser\Extension\TableParser;
use SyntaxPhoenix\EJSParserBundle\Parser\Extension\HeaderParser;
use SyntaxPhoenix\EJSParserBundle\Parser\EditorjsParserExtension;
use SyntaxPhoenix\EJSParserBundle\Parser\Extension\WarningParser;
use SyntaxPhoenix\EJSParserBundle\Parser\Extension\DelimiterParser;
use SyntaxPhoenix\EJSParserBundle\Parser\Extension\ParagraphParser;
use SyntaxPhoenix\EJSParserBundle\Parser\Extension\SimpleImageParser;
use SyntaxPhoenix\EJSParserBundle\Parser\Extension\YoutubeEmbedParser;

class EditorjsParser
{
    private StdClass $data;
    private DOMDocument $dom;
    private HTML5 $html5;
    private string $prefix = "prs";
    /** @var array<string, EditorjsParserExtension> */
    private array $parser = [];

    public function __construct(?object $data = null)
    {
        if ($data != null) {
            $this->setData($data);
        }

        $this->parser = [
            'header' => new HeaderParser(),
            'delimiter' => new DelimiterParser(),
            'code' => new CodeParser(),
            'paragraph' => new ParagraphParser(),
            'link' => new LinkParser(),
            'embed' => new EmbedParser(),
            'raw' => new RawParser(),
            'list' => new ListParser(),
            'warning' => new WarningParser(),
            'simpleImage' => new SimpleImageParser(),
            'image' => new ImageParser(),
            'table' => new TableParser(),
            'alert' => new AlertParser(),
            'youtubeembed' => new YoutubeEmbedParser()
        ];
    }

    public function setData(object $data): void
    {
        $this->data = $data;

        $this->dom = new DOMDocument(1.0, 'UTF-8');

        $this->html5 = new HTML5([
            'target_document' => $this->dom,
            'disable_html_ns' => true
        ]);
    }

    public function toHtml(): string
    {
        try {
            $this->render();
    
            return $this->dom->saveHTML();
        } catch (NoBlockException $exception) {
            return '';
        }
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
            throw new NoBlockException('No Blocks to parse !');
        }
        foreach ($this->data->blocks as $block) {
            if (array_key_exists($block->type, $this->parser)) {
                $this->dom->appendChild(
                    $this->parser[$block->type]->parseBlock($this->html5, $this->dom, $block, $this->prefix)
                );
            } else {
                throw new Exception('Not parseable type: ' . $block->type . '!');
            }
        }
    }
}