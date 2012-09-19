<?php

/**
 * Asset loader, if no cache directory is available
 */
class Prism_Detached_AssetsLoader_Default extends Prism_Detached_AssetsLoader_Base
{
    /**
     * Registers the assets
     */
    public function registerAssets ()
    {
        $coreDependency = array();

        foreach ($this->extensionLoader->getActiveExtensions() as $extension)
        {
            if ($extension instanceof Prism_Detached_Extension_Core)
            {
                $coreDependency = $extension->getId();
                $dependency = array();
            }
            else
            {
                $dependency = $coreDependency;
            }

            foreach ($extension->getJavascript() as $javascript)
            {
                wp_enqueue_script(
                    'prism-detached-' . $extension->getId(),
                    $extension->getWebServerPathToExtension() . $javascript,
                    $dependency,
                    false,
                    true
                );
            }

            foreach ($extension->getCss() as $css)
            {
                wp_enqueue_style(
                    'prism-detached-' . $extension->getId(),
                    $extension->getWebServerPathToExtension() .  $css,
                    $dependency,
                    false,
                    "all"
                );
            }
        }
    }
}