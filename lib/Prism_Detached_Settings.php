<?php

/**
 * Handles the settings of the plugin
 */
class Prism_Detached_Settings
{
    /**
     * Flag, whether invisibles should be shown
     *
     * @var bool
     */
    private $showInvisibles;


    /**
     * Flag, whether autolinker should be activated
     *
     * @var bool
     */
    private $autolinker;


    /**
     * The chosen theme id
     *
     * @var string
     */
    private $theme;


    /**
     * The options values
     */
    const OPTION_PREFIX = 'prism-detached-';


    /**
     * The settings group
     */
    const SETTINGS_GROUP = 'prism-detached-settings';



    /**
     * Constructs a new prism settings dialog
     */
    public function __construct ()
    {
        $this->showInvisibles = (bool) $this->getOption('invisibles');
        $this->autolinker = (bool) $this->getOption('autolinker');
        $this->theme = $this->getOption('theme');
    }



    /**
     * Stores an option
     *
     * @param string $key
     * @param bool $isVisible
     */
    private function storeOption ($key, $isVisible)
    {
        update_option(self::OPTION_PREFIX . $key, $isVisible);
    }



    /**
     * Returns the options
     *
     * @param string $key
     *
     * @return bool
     */
    private function getOption ($key)
    {
        return get_option(self::OPTION_PREFIX . $key);
    }



    /**
     * Activates the autolinker
     *
     * @param bool $autolinker
     */
    public function setAutolinker ($autolinker)
    {
        if ($this->autolinker != $autolinker)
        {
            $this->autolinker = $autolinker;
            $this->storeOption('autolinker', (int) $autolinker);
        }
    }



    /**
     * Returns, whether the autolinker is activated
     *
     * @return bool
     */
    public function getAutolinker ()
    {
        return $this->autolinker;
    }



    /**
     * Sets, whether invisibles should be shown
     *
     * @param bool $showInvisibles
     */
    public function setShowInvisibles ($showInvisibles)
    {
        if ($this->showInvisibles != $showInvisibles)
        {
            $this->showInvisibles = $showInvisibles;
            $this->storeOption('invisibles', (int) $showInvisibles);
        }
    }



    /**
     * Returns, whether invisibles are shown
     *
     * @return bool
     */
    public function getShowInvisibles ()
    {
        return $this->showInvisibles;
    }



    /**
     * @param string $theme
     */
    public function setTheme ($theme)
    {
        if (Prism_Detached_Assets::themeExists($theme) && ($this->theme != $theme))
        {
            $this->theme = $theme;
            $this->storeOption('theme', $theme);
        }
    }



    /**
     * @return string
     */
    public function getTheme ()
    {
        return $this->theme;
    }



    /**
     * Adds the options with default values
     */
    public static function addOptions ()
    {
        add_option(self::OPTION_PREFIX . 'invisibles', 0);
        add_option(self::OPTION_PREFIX . 'autolinker', 0);
        add_option(self::OPTION_PREFIX . 'theme', Prism_Detached_Assets::getDefaultTheme());
    }



    /**
     * Deletes the options
     */
    public static function deleteOptions ()
    {
        delete_option(self::OPTION_PREFIX . 'invisibles');
        delete_option(self::OPTION_PREFIX . 'autolinker');
        delete_option(self::OPTION_PREFIX . 'theme');
    }
}