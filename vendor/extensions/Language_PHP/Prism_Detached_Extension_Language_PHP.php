<?php


/**
 * Additional language: PHP
 */
class Prism_Detached_Extension_Language_PHP extends Prism_Detached_Extension_Base
{
    /**
     * Returns the name of the extension
     *
     * @return string
     */
    public function getName ()
    {
        return "Language: PHP (experimental)";
    }



    /**
     * Returns the sort order of the extension.
     * It is ordered ascending.
     *
     * @return int|float
     */
    public function getSortOrder ()
    {
        return 20;
    }



    /**
     * Returns the css files
     *
     * @return string[]
     */
    public function getCss ()
    {
        return array(
            "css/{$this->theme}.min.css"
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
            "js/prism-php.min.js"
        );
    }
}