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
        return "Plugin: Autolinker";
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
            "css/prism-autolinker.min.css"
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
            "js/prism-autolinker.min.js"
        );
    }


}