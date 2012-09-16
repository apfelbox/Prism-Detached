<?php
/*
Plugin Name: Prism Syntax Highlighter (detached)
Plugin URI: http://apfelbox.net
Description: Includes the prism syntax highlighter in WordPress by using Custom Fields.
Version: 1.2
Author: Jannik Zschiesche
Author URI: http://apfelbox.net
License: GPL2
*/

// Load dependencies
require_once 'lib/Prism_Detached_Shortcode.php';
require_once 'lib/Prism_Detached_Shortcode_Parameters.php';
require_once 'lib/Prism_Detached_Admin.php';
require_once 'lib/Prism_Detached_Settings.php';
require_once 'lib/Prism_Detached_Assets.php';

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
     */
    const PRISM_VERSION = '34f0bd5247';

    /**
     * Initializes the prism plugin
     */
    public function init ()
    {
        // Register the [prism] short code
        Prism_Detached_Shortcode::register();

        $this->registerHooks();
    }



    /**
     * Registers the used hooks
     */
    private function registerHooks ()
    {
        register_activation_hook(__FILE__, array($this, 'onActivation'));
        register_deactivation_hook(__FILE__, array($this, 'onDeactivation'));

        add_action('wp_enqueue_scripts', array($this, 'registerNeededAssets'));
        add_action('admin_menu', array($this, 'registerAdminPage'));
    }



    /**
     * Registers the needed assets in WordPress
     */
    public function registerNeededAssets ()
    {
        $assets = new Prism_Detached_Assets($this);
        $assets->register();

        $settings = new Prism_Detached_Settings();
        $assets->enqueue($settings);
    }



    /**
     * On activation callback
     */
    public function onActivation ()
    {
        Prism_Detached_Settings::addOptions();
    }



    /**
     * On deactivation callback
     */
    public function onDeactivation ()
    {
        Prism_Detached_Settings::deleteOptions();
    }



    /**
     * Returns a absolute url to a path relative in the plugin directory
     *
     * @param string $relativeUrl
     *
     * @return string
     */
    public function getRelativePluginUrl ($relativeUrl)
    {
        return plugin_dir_url(__FILE__) . $relativeUrl;
    }



    /**
     * Registers the admin page
     */
    public function registerAdminPage ()
    {
        $adminPage = new Prism_Detached_Admin();
        $adminPage->registerPage();
    }
}