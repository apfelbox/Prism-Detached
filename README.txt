=== Plugin Name ===
Contributors: apfelbox
Tags: prism, syntax highlighting
Requires at least: 3.4.0
Tested up to: 3.5.2
Stable tag: 1.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds Prism Syntax Highlighting to WordPress, using custom fields for your code examples.



== Description ==

Integrates the [Prism Syntax Highlighting Library](https://github.com/LeaVerou/prism) in WordPress.

It is called *detached*, since the code examples are not stuffed into the rich text editor, together with all the
other texts and content, but they are added separately as custom fields and just referenced via short tags (like footnotes).

Check *Other Notes* for usage documentation.

The official development repository is [hosted on Github](https://github.com/apfelbox/Prism-Detached).


== Installation ==

1. Upload the files to your `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress



== Frequently Asked Questions ==

= Why use custom tags? =

The (rich text) editor of WordPress is quite good in mangling in manually added code.  This cannot happen with custom fields.
Also, I personally, think it is more user-friendly.



== Screenshots ==

1. Add the code as custom field and reference it in the rich text editor via shortcode.
2. Code highlighting in the frontend
3. You can also specify some lines, which should be marked
4. Code highlighting with marked lines in the frontend
5. Plugin options screen



== Changelog ==

= 1.5 =
* Updated PrismJS to commit: 07c0f4f6b2
* Added plugin descriptions
* Added new plugins: File Highlight, WebPlatform Docs
* Added language-code descriptions
* Added new languages: Bash (Unix Shell), C, C-like, Coffeescript, C++, Groovy, PHP, Python, Sassy CSS, and SQL
* Added new themes: Okaida, Tomorrow, Twilight
** 1.5 update brought to you by JC John Sese Cuneta (http://jcsesecuneta.com) ** thank you!

= 1.4 =
* Fixed a compatibility problem with older PHP versions (< 5.4)

= 1.3 =
* Minor optical updates of the admin interface
* Refactored nearly complete plugin
* Added support for generic extensions
* Added cached assets loader
* Added support for experimental PHP plugin

= 1.2 =
* Updated the prism library to `34f0bd5247`

= 1.1 =
* Load line-highlight correctly
* Moved html attributes to the correct tag
* Fixed wrong asset loading

= 1.0 =
* Initial commit



== Upgrade Notice ==

No upgrade notice yet, just use it and give feedback. :-)



== Usage ==

The basic procedure is:

1. Create a custom field and paste the code into it.
2. Insert the `[prism ...]` shorttag in your code, where you want the code block to appear.


= Shorttag =
`[prism key=".." language=".." line=".." line_offset=".." post=".."]`

* `key`: the name of the custom field, which contains the code (**required**)
* `language`: the language to highlight
* `line`: highlighted lines (for syntax, check the [offical docs](http://prismjs.com/plugins/line-highlight/))
* `line_offset`: the offset, with which the line numbering should start
* `post`:  if you want to include a code piece of another post, you can explicitly specify the post id here


= Cached Assets loader =
The plugin includes (from v1.3 on) a cached assets loader, so that all needed assets are concatenated into
one js and one css file to minimize the HTTP requests.
To make use of the cached assets loader, just create a directory `/cache/` inside your plugin directory and make it writable for PHP.


= Supported languages =

Only the ones from the official PrismJS repository

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

= Creating Custom Extensions =
Please read the wiki page: [Creating A Custom Extension](https://github.com/apfelbox/Prism-Detached/wiki/Creating-A-Custom-Extension).