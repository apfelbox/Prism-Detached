<?php

/**
 * Base class for all extension loaders
 */
abstract class Prism_Detached_AssetsLoader_Base
{
    /**
     * @var Prism_Detached_Extension_Loader
     */
    protected $extensionLoader;



    /**
     * Handles
     *
     * @param Prism_Detached_Extension_Loader $extensionLoader
     */
    public function __construct (Prism_Detached_Extension_Loader $extensionLoader)
    {
        $this->extensionLoader = $extensionLoader;
    }



    /**
     * Registers the assets
     */
    abstract public function registerAssets ();



    /**
     * Regenerates the assets
     */
    public function regenerate ()
    {

    }
}