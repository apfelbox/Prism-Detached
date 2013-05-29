<?php

/**
 * Prism Plugin: Autolinker
 */
class Prism_Detached_Extension_Prism_Autolinker extends Prism_Detached_Extension_Base
{
    /**
     * Returns the name of the extension
     *
     * @return string
     */
    public function getName ()
    {
        return 'Plugin: Autolinker';
    }



    /**
     * Returns the name of the extension
     *
     * @return string
     */
    public function getDesc ()
    {
        return 'Converts URLs and emails in code to clickable links.  Parses <a href="http://daringfireball.net/projects/markdown/" target="_blank">Markdown</a> links in comments.
            <p>URLs and emails will be linked automatically, you don\'t need to do anything.  To link some text inside a comment to a certain URL, you may use the Markdown syntax: <pre><code class="language-markdown">[Text you want to see](http://url-goes-here.com)</code></pre></p>
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
            'css/prism-autolinker.min.css'
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
            'js/prism-autolinker.min.js'
        );
    }


}