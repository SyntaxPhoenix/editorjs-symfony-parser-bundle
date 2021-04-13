<?php

namespace SyntaxPhoenix\EJSParserBundle\Twig;

use SyntaxPhoenix\EJSParserBundle\Parser\EditorjsParser;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;

class EditorjsExtension extends AbstractExtension
{

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('editorjs_parse', [$this, 'editorjsParse']),
        ];
    }

    /**
     * @param array $data
     */
    public function editorjsParse(object $data): string
    {
        $parser = new EditorjsParser($data);
        return $parser->toHtml();
    }
    
}