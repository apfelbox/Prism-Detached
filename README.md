Prism Detached
==============

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


## Supported languages

Currently only the ones from the official repository

* css
* java
* javascript
* markup



## Q&A

> Why use custom tags?

The (wysiwyg) editor of WordPress is quite good in mangling in manually added code. This cannot happen with custom fields.
Also, I personally, think it is more user-friendly.