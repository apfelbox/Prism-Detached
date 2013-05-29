Prism Detached
==============

You can find it in the official [WordPress Plugin Directory](http://wordpress.org/extend/plugins/prism-detached/)
or install it directly via the plugins menu in the WordPress admin area.

Integrates the [Prism Syntax Highlighting Library](https://github.com/LeaVerou/prism) in WordPress.


## Usage

First you should download and activate the plugin.


The basic procedure is:

1. Create a custom field and paste the code into it.
2. Insert the `[prism ...]` shorttag in your code, where you want the code block to appear.


### Shorttag
```
[prism key=".." language=".." line=".." line_offset=".." post=".."]
```

* `key`: the name of the custom field, which contains the code (**required**)
* `language`: the language to highlight
* `line`: highlighted lines (for syntax, check the [offical docs](http://prismjs.com/plugins/line-highlight/))
* `line_offset`: the offset, with which the line numbering should start
* `post`:  if you want to include a code piece of another post, you can explicitly specify the post id here


### Cached Assets loader
The plugin includes (from v1.3 on) a cached assets loader, so that all needed assets are concatenated into
one js and one css file to minimize the HTTP requests.
To make use of the cached assets loader, just create a directory `/cache/` inside your plugin directory and make it writable for PHP.


## Supported languages

Only the ones from the official PrismJS Git repository

* bash (Bash Unix Shell)
* c
* clike
* coffeescript
* cpp (C++)
* css
* groovy
* java
* javascript
* markup (like: xHTML, MathML, SVG, LaTeX, RSS, XML, OWL, etc.)
* php
* python
* scss (Sassy CSS)
* sql



## Supported themes

Only the ones from the official PrismJS Git repository

* Default
* Dark
* Funky
* Okaida
* Tomorrow
* Twilight


## Q&A

> Why use custom tags?

The (RTE) editor of WordPress is quite good in mangling in manually added code.  This cannot happen with custom fields.
Also, I personally, think it is more user-friendly.


## Screenshots
![Add the code as custom field and reference it in the wysiwyg editor via shortcode.](https://raw.github.com/apfelbox/Prism-Detached/master/screenshot-1.png)

Add the code as custom field and reference it in the wysiwyg editor via shortcode.


![Code highlighting in the frontend](https://raw.github.com/apfelbox/Prism-Detached/master/screenshot-2.png)

Code highlighting in the frontend


![You can also specify some lines, which should be marked](https://raw.github.com/apfelbox/Prism-Detached/master/screenshot-3.png)

You can also specify some lines, which should be marked


![Code highlighting with marked lines in the frontend](https://raw.github.com/apfelbox/Prism-Detached/master/screenshot-4.png)

Code highlighting with marked lines in the frontend


![Plugin options screen](https://raw.github.com/apfelbox/Prism-Detached/master/screenshot-5.png)

Plugin options screen