[![Contributors][contributors-shield]][contributors-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![GPLv3 License][license-shield]][license-url]
 



<!-- PROJECT LOGO -->
<br />
<p align="center">
  <a href="https://github.com/SyntaxPhoenix/editorjs-symfony-parser-bundle">
    <img src="https://cdn.syntaxphoenix.com/images/logo.png" alt="Logo" width="192" height="192"/>
  </a>

  <h3 align="center">EditorJS Symfony Parser Bundle</h3>
</p>



<!-- TABLE OF CONTENTS -->
<details open="open">
  <summary><h2 style="display: inline-block">Table of Contents</h2></summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#usage">Usage</a>
      <ul>
        <li><a href="#installation">Installation</a></li> 
        <li><a href="#supported-plugins">Supported plugins</a></li> 
        <li><a href="#methods">Methods</a></li>
      </ul>
    </li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project
The EditorJS-ParserBundle parses editorjs-configs [Editor.js](https://editorjs.io/ "Editor.js Homepage"). It is designed to be best integrated in Symfony and also offers a Twig-Extension. The bundle is based on [Durlecode/editorjs-simple-html-parser](https://github.com/Durlecode/editorjs-simple-html-parser), but strongly improved the parsing by using an object-oriented approach.


### Built With

* [editorjs-simple-html-parser](https://github.com/Durlecode/editorjs-simple-html-parser)


<!-- GETTING STARTED -->
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

### Installation

```
composer require syntaxphoenix/editorjs-symfony-parser-bundle
```


## Supported Plugins

Package | Key | Main CSS Class
--- | --- | ---
<a href="https://github.com/editor-js/code">@editorjs/code</a> | `code` | `.prs-code`
<a href="https://github.com/editor-js/embed">@editorjs/embed</a> | `embed` | `.prs-embed`
<a href="https://github.com/editor-js/delimiter">@editorjs/delimiter</a> | `delimiter` | `.prs-delimiter`
<a href="https://github.com/editor-js/header">@editorjs/header</a> | `header` | `.prs-h{header-level}`
<a href="https://github.com/editor-js/link">@editorjs/link</a> | `link` | `.prs-link`
<a href="https://github.com/editor-js/list">@editorjs/list</a> | `list` | `.prs-list`
<a href="https://github.com/editor-js/paragraph">@editorjs/paragraph</a> | `paragraph` | `.prs-paragraph`
<a href="https://github.com/editor-js/raw">@editorjs/raw</a> | `raw` | 
<a href="https://github.com/editor-js/simple-image">@editorjs/simple-image</a> | `simpleImage` | `.prs-image`
<a href="https://github.com/editor-js/image">@editorjs/image</a> | `image` | `.prs-image`
<a href="https://github.com/editor-js/warning">@editorjs/warning</a> | `warning` | `.prs-warning`
<a href="https://github.com/editor-js/table">@editorjs/table</a> | `table` | `.prs-table`
<a href="https://github.com/vishaltelangre/editorjs-alert">@editorjs/table</a> | `table` | `.prs-alert` + `.prs-alert-{type}`

If you want to add a new Parser for a specific editorjs-plugin you can fork the master and make a pull-request. Please also change the readme in that case and add the parser you have edited. 


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

##### Alert

```html
<div class="prs-alert prs-alert-{type}">
 <div>My Text</div>
</div>
```

<!-- ROADMAP -->
## Roadmap

See the [open issues](https://github.com/SyntaxPhoenix/editorjs-symfony-parser-bundle/issues) for a list of proposed features (and known issues).



<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to be learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request



<!-- LICENSE -->
## License

Distributed under the GPLv3 License. See `LICENSE` for more information.



<!-- CONTACT -->
## Contact

[@SyntaxPhoenix](https://twitter.com/SyntaxPhoenix) - support@syntaxphoenix.com

Project Link: [https://github.com/SyntaxPhoenix/editorjs-symfony-parser-bundle](https://github.com/SyntaxPhoenix/editorjs-symfony-parser-bundle)





<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/SyntaxPhoenix/editorjs-symfony-parser-bundle.svg?style=flat-square
[contributors-url]: https://github.com/SyntaxPhoenix/editorjs-symfony-parser-bundle/graphs/contributors
[stars-shield]: https://img.shields.io/github/stars/SyntaxPhoenix/editorjs-symfony-parser-bundle.svg?style=flat-square
[stars-url]: https://github.com/SyntaxPhoenix/editorjs-symfony-parser-bundle/stargazers
[issues-shield]: https://img.shields.io/github/issues/SyntaxPhoenix/editorjs-symfony-parser-bundle.svg?style=flat-square
[issues-url]: https://github.com/SyntaxPhoenix/editorjs-symfony-parser-bundle/issues
[license-shield]: https://img.shields.io/badge/License-GPLv3-blue.svg?style=flat-square
[license-url]: https://www.gnu.org/licenses/gpl-3.0
