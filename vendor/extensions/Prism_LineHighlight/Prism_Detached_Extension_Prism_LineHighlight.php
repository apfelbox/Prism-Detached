<?php


/**
 * Prism Plugin: Line Highlight
 */
class Prism_Detached_Extension_Prism_LineHighlight extends Prism_Detached_Extension_Base
{
    /**
     * Returns the name of the extension
     *
     * @return string
     */
    public function getName ()
    {
        return 'Plugin: Line Highlight';
    }



    /**
     * Returns the name of the extension
     *
     * @return string
     */
    public function getDesc ()
    {
        return 'Highlights specific lines and/or line ranges.
            <p>Obviously, this only works on code blocks (<code>&lt;pre&gt;&lt;code&gt;</code>) and not for in-line code.</p>

            <p>You specify the lines to be highlighted through the <code>data-line</code> attribute on the <code>&lt;pre&gt;</code> element, in the following simple format:
                <ol>
                    <li>A single number refers to the line with that number</li>
                    <li>Ranges are denoted by two numbers, separated with a hyphen (-)</li>
                    <li>Multiple line numbers or ranges are separated by commas.</li>
                    <li>Whitespace is allowed anywhere and will be stripped off.</li>
                </ol>
            </p>

            <p>In case you want the line numbering to be offset by a certain number (for example, you want the 1st line to be number 41 instead of 1, which is an offset of 40), you can additionally use the <code>data-line-offset</code> attribute.</p>

            <p>You can also link to specific lines on any code snippet, by using the following as a url hash: <code>#{element-id}.{lines}</code> where <code>{element-id}</code> is the id of the <code>&lt;pre&gt;</code> element and <code>{lines}</code> is one or more lines or line ranges that follow the format outlined above.  For example, if there is an element with <code>id="play"</code> on the page, you can link to lines 5-6 by linking to <code>&lt;a href="example-file/#play.5-6"&gt;#play.5-6&lt;/a&gt;</code></p>
        ';
    }



    /**
     * Returns the sort order of the extension.
     * It is ordered ascending.
     *
     * @return int|float
     */
    public function getSortOrder ()
    {
        return 50;
    }



    /**
     * Returns the css files
     *
     * @return string[]
     */
    public function getCss ()
    {
        return array(
            'css/prism-line-highlight.min.css'
        );
    }



    /**
     * Returns the JavaScript files
     *
     * @return array|string[]
     */
    public function getJavascript ()
    {
        return array(
            'js/prism-line-highlight.min.js'
        );
    }
}