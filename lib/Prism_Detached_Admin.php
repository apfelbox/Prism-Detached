<?php

/**
 * Handles the plugin's admin
 */
class Prism_Detached_Admin
{
    /**
     * The page id
     */
    const PAGE_ID = 'prism-detached';

    /**
     * Registers the admin page
     */
    public function registerPage ()
    {
        add_options_page( "Prism Detached", "Prism Detached", "manage_options", self::PAGE_ID, array($this, "displayPage"));
    }



    /**
     * Displays the admin page
     */
    public function displayPage ()
    {
        $settings = new Prism_Detached_Settings();

        if (isset($_POST['settings']) && is_array($_POST['settings']))
        {
            $formData = $_POST['settings'];

            $settings->setShowInvisibles( (isset($formData['invisibles']) && ('1' == $formData['invisibles'])) );
            $settings->setAutolinker( (isset($formData['autolinker']) && ('1' == $formData['autolinker'])) );

            if (isset($formData['theme']))
            {
                $settings->setTheme($formData['theme']);
            }
        }

        // template variables
        $pageUrl = admin_url('options-general.php?page=' . self::PAGE_ID);
        $invisibles = $settings->getShowInvisibles();
        $autolinker = $settings->getAutolinker();
        $theme = $settings->getTheme();
        $availableThemes = Prism_Detached_Assets::getThemes();

        include dirname(__DIR__) . '/templates/admin_settings.php';
    }
}