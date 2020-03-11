<?php

namespace Durlecode\EJSParser\Tests;

use Durlecode\EJSParser\Parser;
use PHPUnit\Framework\TestCase;
use Exception;

class ParserTest extends TestCase
{
    protected $seed;
    protected $emptyBlocks;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->seed = file_get_contents(__DIR__ . '/data/seed.json');

        $this->emptyBlocks = file_get_contents(__DIR__ . '/data/empty-blocks.json');

        parent::__construct($name, $data, $dataName);
    }

    public function testToHtml()
    {
        $this->assertIsString(Parser::parse($this->seed)->toHtml());
    }

    public function testGetters()
    {
        $parser = new Parser($this->seed);

        $prefix = "trd";

        $this->assertEquals("prs", $parser->getPrefix());

        $parser->setPrefix($prefix);

        $this->assertEquals($prefix, $parser->getPrefix());

        $this->assertIsInt($parser->getTime());

        $this->assertIsArray($parser->getBlocks());

        $this->assertIsString($parser->getVersion());
    }

    public function testToHtmlWithoutBlocks()
    {
        $this->expectException(Exception::class);

        $this->expectExceptionMessage('No Blocks to parse !');

        Parser::parse($this->emptyBlocks)->toHtml();
    }
}
