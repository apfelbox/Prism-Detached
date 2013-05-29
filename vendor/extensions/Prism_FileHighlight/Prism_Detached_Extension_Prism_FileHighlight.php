<?php


/**
 * Prism Plugin: WebPlatform Docs
 */
class Prism_Detached_Extension_Prism_FileHighlight extends Prism_Detached_Extension_Base
{
    /**
     * Returns the name of the extension
     *
     * @return string
     */
    public function getName ()
    {
        return 'Plugin: File Highlight';
    }



    /**
     * Returns the name of the extension
     *
     * @return string
     */
    public function getDesc ()
    {
        return 'Fetch external files and highlight them with Prism.  Used on the Prism website itself.
            <p>Use the <code>data-src</code> attribute on empty <code>&lt;pre></code> elements, like so: <pre><code>&lt;pre data-src="myfile.js"&gt;&lt;/pre&gt;</code></pre></p>

            <p>You don\'t need to specify the language, it\'s automatically determined by the file extension.  If, however, the language cannot be determined from the file extension or the file extension is incorrect, you may specify a language as well (with the usual class name way).</p>

            <p>Please note that the files are fetched with XMLHttpRequest.  This means that if the file is on a different origin, fetching it will fail, unless CORS is enabled on that website.</p>
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
        // needs to be quite high, since the plugin is iterating over all existing languages (= all languages
        // should be lower than that).
        return 50;
    }



    /**
     * Returns the css files
     *
     * @return string[]
     */
    /* public function getCss ()
    {
        return array(
            'css/prism-highlight.min.css'
        );
    } */



    /**
     * Returns the JavaScript files
     *
     * @return array|string[]
     */
    public function getJavascript ()
    {
        return array(
            'js/prism-file-highlight.min.js'
        );
    }
}