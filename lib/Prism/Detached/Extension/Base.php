<?php

/**
 * The base class for all extensions
 */
abstract class Prism_Detached_Extension_Base
{
    /**
     * The file system path to the extension
     *
     * @var string
     */
    private $fileSystemPathToExtension;


    /**
     * The web server path to the extension directory
     *
     * @var string
     */
    private $webServerPathToExtension;


    /**
     * The chosen theme
     *
     * @var string
     */
    protected $theme;


    /**
     * Flag, whether the extension is active
     *
     * @var bool
     */
    private $isActive = false;



    /**
     * Constructs a new extension
     *
     * @param string $fileSystemPathToExtension
     * @param string $webServerPathToExtension
     * @param string $theme
     */
    public function __construct ($fileSystemPathToExtension, $webServerPathToExtension, $theme)
    {
        $this->fileSystemPathToExtension = rtrim($fileSystemPathToExtension, '/') . '/';
        $this->webServerPathToExtension  = rtrim($webServerPathToExtension,  '/') . '/';
        $this->theme = $theme;
    }



    /**
     * Returns the ID of the extension - should be unique
     *
     * @return string
     */
    public function getId ()
    {
        return get_class($this);
    }



    /**
     * Returns the sort order of the extension.
     * It is ordered ascending.
     *
     * @return int|float
     */
    abstract public function getSortOrder ();



    /**
     * Returns the name of the extension
     *
     * @return string
     */
    abstract public function getName ();



    /**
     * Returns the description of the extension
     *
     * @return string
     */
    abstract public function getDesc ();



    /**
     * Returns the JavaScript files of the extension.
     * The return value should be an array of relative paths to the files.
     *
     * @return string[]
     */
    public function getJavascript ()
    {
        return array();
    }



    /**
     * Returns the CSS files of the extension.
     * The return value should be an array of relative paths to the files.
     *
     * @return string[]
     */
    public function getCss ()
    {
        return array();
    }



    /**
     * Sets the extension as activated
     *
     * @param boolean $isActive
     */
    final public function setIsActive ($isActive)
    {
        $this->isActive = (bool) $isActive;
    }



    /**
     * Returns, whether the extension is active
     *
     * @return boolean
     */
    final public function isActive ()
    {
        return $this->isActive;
    }



    /**
     * Returns the full file system path to the extension (including a trailing slash)
     *
     * @return string
     */
    public function getFileSystemPathToExtension ()
    {
        return $this->fileSystemPathToExtension;
    }



    /**
     * Returns the full web server path to the extension (including a trailing slash)
     *
     * @return string
     */
    public function getWebServerPathToExtension ()
    {
        return $this->webServerPathToExtension;
    }
}