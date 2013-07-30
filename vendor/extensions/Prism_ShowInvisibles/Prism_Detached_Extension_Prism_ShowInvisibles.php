<?php


/**
 * Prism Plugin: Show Invisibles
 */
class Prism_Detached_Extension_Prism_ShowInvisibles extends Prism_Detached_Extension_Base
{
    /**
     * Returns the name of the extension
     *
     * @return string
     */
    public function getName ()
    {
        return 'Plugin: Show Invisibles';
    }



    /**
     * Returns the name of the extension
     *
     * @return string
     */
    public function getDesc ()
    {
        return 'Show hidden characters such as tabs and line breaks.';
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
    public function getCss ()
    {
        return array(
            'css/prism-show-invisibles.min.css'
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
            'js/prism-show-invisibles.min.js'
        );
    }
}