<?php


/**
 * Prism Plugin: WebPlatform Docs
 */
class Prism_Detached_Extension_Prism_WebPlatformDocs extends Prism_Detached_Extension_Base
{
    /**
     * Returns the name of the extension
     *
     * @return string
     */
    public function getName ()
    {
        return "Plugin: WebPlatform Docs";
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
        return 60;
    }



    /**
     * Returns the css files
     *
     * @return string[]
     */
    public function getCss ()
    {
        return array(
            "css/prism-wpd.min.css"
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
            "js/prism-wpd.min.js"
        );
    }
}