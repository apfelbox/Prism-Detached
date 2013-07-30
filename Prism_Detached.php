<?php
/*
Plugin Name: Prism Syntax Highlighter (detached)
Plugin URI: https://github.com/apfelbox/Prism-Detached
Description: Includes the prism syntax highlighter in WordPress by using Custom Fields.
Version: 1.5
Author: Jannik Zschiesche
Update: JC John Sese Cuneta
Author URI: http://apfelbox.net
Update URI: http://jcsesecuneta.com
License: GPL2
*/

// Start script
$prism = new Prism_Detached();
$prism->init();


/**
 * Main Controller for the prism plugin
 */
class Prism_Detached
{
    /**
     * The used prism version
     *
     * @var string
     */
    const PRISM_VERSION = '07c0f4f6b2';


    /**
     * The plugin version
     *
     * @var string
     */
    const PLUGIN_VERSION = '1.5';


    /**
     * The prism settings
     *
     * @var Prism_Detached_Settings
     */
    private $settings;


    /**
     * The extension loader
     *
     * @var Prism_Detached_Extension_Loader
     */
    private $extensionLoader;


    /**
     * The admin handler
     *
     * @var Prism_Detached_Admin
     */
    private $admin;


    /**
     * Constructs a new prism detached plugin handler
     */
    public function __construct ()
    {
        // register autoloader
        $this->registerAutoloader();

        // create settings
        $this->settings = new Prism_Detached_Settings();

        // create extension loader
        $extensionDir = __DIR__ . '/vendor/extensions';
        $extensionUrl = plugins_url('', __FILE__) . '/vendor/extensions';
        $this->extensionLoader = new Prism_Detached_Extension_Loader($extensionDir, $extensionUrl, $this->settings);

        // add the extension loader to the settings
        $this->settings->setExtensionLoader($this->extensionLoader);

        // create admin handler
        $this->admin = new Prism_Detached_Admin($this->extensionLoader, $this->settings);
    }



    /**
     * Registers the autoloader for the plugin
     */
    private function registerAutoloader ()
    {
        $baseDir = __DIR__ . "/lib/";

        spl_autoload_register(
            function ($className) use ($baseDir)
            {
                if (substr($className, 0, 14) !== "Prism_Detached")
                {
                    return;
                }

                $filePath = $baseDir . str_replace('_', '/', trim($className, '/')) . '.php';

                if (is_file($filePath))
                {
                    require_once $filePath;
                }
            }
        );
    }


    /**
     * Initializes the prism plugin
     */
    public function init ()
    {
        // Register the [prism] short code
        Prism_Detached_Shortcode_Handler::register();


        // register the necessary hooks
        $this->registerHooks();
    }



    /**
     * Registers the used hooks
     */
    private function registerHooks ()
    {
        register_deactivation_hook(__FILE__, array($this, 'onDeactivation'));

        add_action('wp_enqueue_scripts', array($this, 'registerNeededAssets'));
        add_action('admin_menu',         array($this, 'registerAdminPage'));
        add_action('admin_init',         array($this, 'onAdminInit'));

        // register to custom actions
        add_action("prism-detached-settings-updated", array($this, 'onSettingsUpdated'));
    }



    /**
     * Registers the needed assets in WordPress
     */
    public function registerNeededAssets ()
    {
        $this->getAssetLoader()->registerAssets();
    }



    /**
     * Returns the asset loader to use
     *
     * @return Prism_Detached_AssetsLoader_Base
     */
    private function getAssetLoader ()
    {
        $cachedLoader = new Prism_Detached_AssetsLoader_Cached($this->extensionLoader, $this->settings, __FILE__);

        return $cachedLoader->isAvailable()
                ? $cachedLoader
                : new Prism_Detached_AssetsLoader_Default($this->extensionLoader);
    }



    /**
     * Callback, when settings are updated
     */
    public function onSettingsUpdated ()
    {
        $cachedLoader = new Prism_Detached_AssetsLoader_Cached($this->extensionLoader, $this->settings, __FILE__);
        $cachedLoader->regenerate();
    }



    /**
     * On deactivation callback
     */
    public function onDeactivation ()
    {
        $this->settings->unregisterSettings();
    }



    /**
     * Registers the admin page
     */
    public function registerAdminPage ()
    {
        $this->admin->registerPage();
    }



    /**
     * Handles the admin_init action
     */
    public function onAdminInit ()
    {
        $this->settings->registerSettings();
    }
}