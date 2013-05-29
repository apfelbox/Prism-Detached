<?php

/**
 * Handles the settings of the plugin
 */
class Prism_Detached_Settings
{
    /**
     * The chosen theme id
     *
     * @var string
     */
    private $theme;


    /**
     * The list of active extensions
     *
     * @var array
     */
    private $activeExtensions;


    /**
     * The cache keys
     *
     * @var array
     */
    private $cacheKeys;


    /**
     * The extension loader
     *
     * @var Prism_Detached_Extension_Loader
     */
    private $extensionLoader;


    /**
     * The available themes
     *
     * @var array
     */
    private static $themes = array(
        'prism' => 'Default Theme',
        'prism-dark' => 'Dark',
        'prism-funky' => 'Funky',
        'prism-okaidia' => 'Okaidia',
        'prism-tomorrow' => 'Tomorrow',
        'prism-twilight' => 'Twilight',
    );


    /**
     * Constructs a new prism settings dialog
     */
    public function __construct ()
    {
        $this->theme            = get_option('prism_detached_theme')      ?: $this->getDefaultTheme();
        $this->activeExtensions = get_option('prism_detached_extensions') ?: array();
        $this->cacheKeys        = get_option('prism_detached_cache_keys') ?: array('js' => null, 'css' => null);
    }



    /**
     * @return string
     */
    public function getTheme ()
    {
        return $this->theme;
    }



    /**
     * @return array
     */
    public function getActiveExtensions ()
    {
        return $this->activeExtensions;
    }



    /**
     * Sets the cache keys
     *
     * @param array $cacheKeys
     */
    public function setCacheKeys (array $cacheKeys)
    {
        $this->cacheKeys = $cacheKeys;
        update_option('prism_detached_cache_keys', $cacheKeys);
    }



    /**
     * Returns the cache keys
     *
     * @return array
     */
    public function getCacheKeys ()
    {
        return $this->cacheKeys;
    }






    /**
     * Registers the settings
     */
    public function registerSettings ()
    {
        // add settings
        register_setting('prism_detached_extensions', 'prism_detached_extensions', array($this, 'validateExtensionsForm'));
        register_setting('prism_detached_theme',      'prism_detached_theme',      array($this, 'validateThemeForm'));
    }



    /**
     * Deletes the options
     */
    public function unregisterSettings ()
    {
        // remove legacy options (up to v1.2)
        delete_option('prism-detached-invisibles');
        delete_option('prism-detached-autolinker');

        // delete current options
        delete_option('prism_detached_cache_keys');

        // unregister settings
        unregister_setting('prism_detached_extensions', 'prism_detached_extensions');
        unregister_setting('prism_detached_theme',      'prism_detached_theme');
    }



    //region Admin Form Handler
    /**
     * Validates the theme form
     *
     * @param string $input
     *
     * @return mixed
     */
    public function validateThemeForm ($input)
    {
        return $this->themeExists($input) ? $input : $this->getDefaultTheme();
    }



    /**
     * Validates the extensions form
     *
     * @param array $input
     *
     * @return array
     */
    public function validateExtensionsForm ($input)
    {
        if (is_array($input))
        {
            $this->extensionLoader->markActiveExtensions($input);
            return $this->extensionLoader->getExtensionsStates();
        }

        return array();
    }
    //endregion



    //region Theme Lists and Defaults
    /**
     * @return array
     */
    public function getAllThemes ()
    {
        return self::$themes;
    }



    /**
     * Returns, whether the given theme exists
     *
     * @param string $themeId
     *
     * @return bool
     */
    public function themeExists ($themeId)
    {
        return array_key_exists($themeId, $this->getAllThemes());
    }



    /**
     * Returns the default theme
     *
     * @return mixed
     */
    public function getDefaultTheme ()
    {
        return current(array_keys($this->getAllThemes()));
    }
    //endregion




    //region Accessors Extension Loader
    /**
     * @param \Prism_Detached_Extension_Loader $extensionLoader
     */
    public function setExtensionLoader ($extensionLoader)
    {
        $this->extensionLoader = $extensionLoader;
    }



    /**
     * @return \Prism_Detached_Extension_Loader
     */
    public function getExtensionLoader ()
    {
        return $this->extensionLoader;
    }
    //endregion
}