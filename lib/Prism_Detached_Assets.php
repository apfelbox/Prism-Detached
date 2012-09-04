<?php

/**
 * Handles the prism assets
 */
class Prism_Detached_Assets
{
    /**
     * @var Prism_Detached
     */
    private $mainController;


    /**
     * The available themes
     *
     * @var array
     */
    private static $themes = array(
        'prism-theme-default' => 'Default Theme',
        'prism-theme-dark' => 'Dark',
        'prism-theme-funky' => 'Funky',
    );



    /**
     * Constructs a new assets handler
     *
     * @param Prism_Detached $mainController
     */
    public function __construct (Prism_Detached $mainController)
    {
        $this->mainController = $mainController;
    }



    /**
     * Registers the assets in wordpress
     */
    public function register ()
    {
        $this->registerCore();
        $this->registerLineHighlight();
        $this->registerAutolinker();
        $this->registerShowInvisibles();
        $this->registerThemes();
    }



    /**
     * Registers the core files
     */
    private function registerCore ()
    {
        // JavaScript
        wp_register_script(
            'prism',
            $this->mainController->getRelativePluginUrl('vendor/prism/components/prism.min.js'),
            array(),
            '0.1',
            true
        );
    }



    /**
     * Registers the "line highlighter" plugin
     */
    private function registerLineHighlight ()
    {
        // CSS
        wp_register_style(
            'prism-line-highlight',
            $this->mainController->getRelativePluginUrl('vendor/prism/plugins/line-highlight/prism-line-highlight.css'),
            array(),
            '0.1',
            'all'
        );

        // JavaScript
        wp_register_script(
            'prism-line-highlight',
            $this->mainController->getRelativePluginUrl('vendor/prism/plugins/line-highlight/prism-line-highlight.min.js'),
            array('prism'),
            '0.1',
            true
        );
    }



    /**
     * Registers the "autolinker" plugin
     */
    private function registerAutolinker ()
    {
        // CSS
        wp_register_style(
            'prism-autolinker',
            $this->mainController->getRelativePluginUrl('vendor/prism/plugins/autolinker/prism-autolinker.css'),
            array(),
            '0.1',
            'all'
        );

        // JavaScript
        wp_register_script(
            'prism-autolinker',
            $this->mainController->getRelativePluginUrl('vendor/prism/plugins/autolinker/prism-autolinker.min.js'),
            array('prism'),
            '0.1',
            true
        );
    }



    /**
     * Registers the "show invisibles" plugin
     */
    private function registerShowInvisibles ()
    {
        // CSS
        wp_register_style(
            'prism-show-invisibles',
            $this->mainController->getRelativePluginUrl('vendor/prism/plugins/show-invisibles/prism-show-invisibles.css'),
            array(),
            '0.1',
            'all'
        );

        // JavaScript
        wp_register_script(
            'prism-show-invisibles',
            $this->mainController->getRelativePluginUrl('vendor/prism/plugins/show-invisibles/prism-show-invisibles.min.js'),
            array('prism'),
            '0.1',
            true
        );
    }



    /**
     * Registers the different themes
     */
    private function registerThemes ()
    {
        // Default
        wp_register_style(
            'prism-theme-default',
            $this->mainController->getRelativePluginUrl('vendor/prism/themes/prism.css'),
            array(),
            '0.1',
            'all'
        );

        // Dark
        wp_register_style(
            'prism-theme-dark',
            $this->mainController->getRelativePluginUrl('vendor/prism/themes/prism-dark.css'),
            array(),
            '0.1',
            'all'
        );

        // Funky
        wp_register_style(
            'prism-theme-funky',
            $this->mainController->getRelativePluginUrl('vendor/prism/themes/prism-funky.css'),
            array(),
            '0.1',
            'all'
        );
    }



    /**
     * Enqueues the assets
     *
     * @param Prism_Detached_Settings $settings
     */
    public function enqueue (Prism_Detached_Settings $settings)
    {
        wp_enqueue_script('prism');
        wp_enqueue_style($settings->getTheme());

        // always load line highlighter
        wp_enqueue_style('prism-line-highlight');
        wp_enqueue_script('prism-line-highlight');

        if ($settings->getAutolinker())
        {
            wp_enqueue_script('prism-autolinker');
            wp_enqueue_style('prism-autolinker');
        }

        if ($settings->getShowInvisibles())
        {
            wp_enqueue_script('prism-show-invisibles');
            wp_enqueue_style('prism-show-invisibles');
        }
    }



    /**
     * @return array
     */
    public static function getThemes ()
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
    public static function themeExists ($themeId)
    {
        return array_key_exists($themeId, self::getThemes());
    }



    /**
     * Returns the default theme
     *
     * @return mixed
     */
    public static function getDefaultTheme ()
    {
        return current(array_keys(self::getThemes()));
    }
}