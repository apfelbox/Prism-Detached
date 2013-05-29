<?php

/**
 *
 */
class Prism_Detached_Extension_Core extends Prism_Detached_Extension_Base
{
    /**
     * Returns the prism extension id
     *
     * @return string
     */
    public function getId ()
    {
        return 'core';
    }



    /**
     * Returns the sort order of the extension.
     * It is ordered ascending.
     *
     * @return int|float
     */
    public function getSortOrder ()
    {
        return 0;
    }



    /**
     * Returns the name of the extension
     *
     * @return string
     */
    public function getName ()
    {
        return 'Prism: Core';
    }



    /**
     * Returns the name of the extension
     *
     * @return string
     */
    public function getDesc ()
    {
        return 'Prism Detached Core';
    }



    /**
     * Returns the defined JavaScripts
     *
     * @return string[]
     */
    public function getJavascript ()
    {
        return array(
            "components/prism.min.js"
        );
    }



    /**
     * Returns the defined CSS files
     *
     * @return string[]
     */
    public function getCss ()
    {
        return array(
            "themes/{$this->theme}.min.css"
        );
    }

}