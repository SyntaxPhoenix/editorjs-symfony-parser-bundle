 [![codecov](https://codecov.io/gh/Durlecode/editorjs-simple-html-parser/branch/master/graph/badge.svg?token=OKG54EX9C3)](https://codecov.io/gh/Durlecode/editorjs-simple-html-parser)
 [![License: GPL v3](https://img.shields.io/badge/License-GPLv3-blue.svg)](https://www.gnu.org/licenses/gpl-3.0)
# EditorJS-ParserBundle for Symfony

The EditorJS-ParserBundle parses editorjs-configs [Editor.js](https://editorjs.io/ "Editor.js Homepage"). It is designed to be best integrated in Symfony and also offers a Twig-Extension. The bundle is based on [Durlecode/editorjs-simple-html-parser](https://github.com/Durlecode/editorjs-simple-html-parser) and strongly improved by using an object-oriented approach.

## Installation

```
composer require syntaxphoenix/editorjs-symfony-parser-bundle
```

## Usage

```php
use SyntaxPhoenix\EJSParserBundle\Parser\EditorjsParser;

$parser = new EditorjsParser($data);
$html = $parser->toHtml();
```

Where `$data` is the clean JSON data coming from Editor.js *See `$data` example below*

```json
{
    "time" : 1583848289745,
    "blocks" : [
        {
            "type" : "header",
            "data" : {
                "text" : "Hello World",
                "level" : 2
            }
        }
    ],
    "version" : "2.16.1"
}
```

## Supported Tools

Package | Key | Main CSS Class
--- | --- | ---
`@editorjs/code` | `code` | `.prs-code`
`@editorjs/embed` | `embed` | `.prs-embed`
`@editorjs/delimiter` | `delimiter` | `.prs-delimiter`
`@editorjs/header` | `header` | `.prs-h{header-level}`
`@editorjs/inline-code` |  | 
`@editorjs/link` | `link` | `.prs-link`
`@editorjs/list` | `list` | `.prs-list`
`@editorjs/marker` |  |
`@editorjs/paragraph` | `paragraph` | `.prs-paragraph`
`@editorjs/raw` | `raw` | 
`@editorjs/simple-image` | `simpleImage` | `.prs-image`
`@editorjs/image` | `image` | `.prs-image`
`@editorjs/warning` | `warning` | `.prs-warning`
`@editorjs/table` | `table` | `.prs-table`

## Methods 

#### `toHtml()`
Return generated HTML

### Generated HTML

##### Code

```html
<div class="prs-code">
    <pre>
        <code></code>
    </pre>
</div>
```

##### Embed 
###### *(Actually working with Youtube, Codepen & Gfycat)*

```html
<div class="prs-embed">
    <iframe src="" height="300"></iframe>
</div>
```

##### Delimiter

```html
<hr class="prs-delimiter">
```

##### Header

```html
<h2 class="prs-h2">Lorem</h2>
```

##### Link

```html
<a href="https://github.com/" target="_blank" class="prs-link">
    <div class="prs-link-container-with-img">
        <div class="prs-link-title">Title</div>
        <div class="prs-link-description">Description</div>
        <div class="prs-link-url">https://example.com/</div>
    </div>
    <div class="prs-link-img-container">
        <img src="https://example.com/cat.png" alt="">
    </div>
</a>
```

##### Ordered List

```html
<div class="prs-list">
    <ol>
        <li></li>
    </ol>
</div>
```

##### Unordered List

```html
<div class="prs-list">
    <ul>
        <li></li>
    </ul>
</div>
```

##### Paragraph

```html
<p class="prs-paragraph">
    <code class="inline-code">Pellentesque</code> 
    <i>malesuada fames</i> 
    <mark class="cdx-marker">tempus</mark>
</p>
```

##### Image

```html
<figure class="prs-image">
    <img src="" class="prs-image-border prs-image-background" alt="">
    <figcaption></figcaption>
</figure>
```

##### Warning

```html
<div class="prs-warning">
    <ion-icon name="information-outline" size="large" aria-label="information outline"></ion-icon>
    <div>
        <p>Title</p>
        <p>Message</p>
    </div>
</div>
```

##### Raw

```html
<div class="prs-raw">
    Raw HTML ...
</div>
```
