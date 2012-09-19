<?php

/**
 * Handles the plugin's admin
 */
class Prism_Detached_Admin
{
    /**
     * The page id
     *
     * @var string
     */
    const PAGE_ID = 'prism-detached';


    /**
     * The extension loader
     *
     * @var Prism_Detached_Extension_Loader
     */
    private $extensionLoader;


    /**
     * The settings
     *
     * @var Prism_Detached_Settings
     */
    private $settings;



    /**
     * Constructs a new admin handler and sets the dependencies
     *
     * @param Prism_Detached_Extension_Loader $extensionLoader
     * @param Prism_Detached_Settings $settings
     */
    public function __construct (Prism_Detached_Extension_Loader $extensionLoader, Prism_Detached_Settings $settings)
    {
        $this->extensionLoader = $extensionLoader;
        $this->settings = $settings;
    }



    /**
     * Registers the admin page
     */
    public function registerPage ()
    {
        add_options_page("Prism Detached", "Prism Detached", "manage_options", self::PAGE_ID, array($this, "displayPage"));
    }



    /**
     * Displays the admin page
     */
    public function displayPage ()
    {
        if (isset($_GET['settings-updated']))
        {
            do_action("prism-detached-settings-updated");
        }

        // template variables
        $theme = $this->settings->getTheme();
        $availableThemes = $this->settings->getAllThemes();
        $availableExtensions = $this->extensionLoader->getAllExtensions();

        include dirname(dirname(dirname(__DIR__))) . '/templates/admin_settings.php';
    }
}