 [![codecov](https://codecov.io/gh/Durlecode/editorjs-simple-html-parser/branch/master/graph/badge.svg?token=OKG54EX9C3)](https://codecov.io/gh/Durlecode/editorjs-simple-html-parser)
 [![License: GPL v3](https://img.shields.io/badge/License-GPLv3-blue.svg)](https://www.gnu.org/licenses/gpl-3.0)
# Simple PHP Parser for Editor.js

Parse to HTML clean JSON Data from [Editor.js](https://editorjs.io/ "Editor.js Homepage")

## Installation

```
composer require durlecode/editorjs-simple-html-parser
```

## Usage

```php
use Durlecode\EJSParser\Parser;

$html = Parser::parse($data)->toHtml();
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

By default this will generate html with css classes with `prs` prefix, so if you want to change it, follow example below

```php
use Durlecode\EJSParser\Parser;

$parser = new Parser($data);

$parser->setPrefix("cat");

$parsed = $parser->toHtml();
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
`@editorjs/warning` | `warning` | `.prs-warning`

## Methods 

#### `toHtml()`
Return generated HTML

#### `setPrefix(string $prefix)`
Set CSS classes Prefix

#### `getPrefix()`
Return current prefix

#### `getVersion()`
Return Editor.js content version

#### `getTime()`
Return Editor.js content timestamp

#### `getBlocks()`
Return Editor.js content blocks

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
