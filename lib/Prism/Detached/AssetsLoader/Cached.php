<?php

/**
 * Asset loader for generating the cached versions
 */
class Prism_Detached_AssetsLoader_Cached extends Prism_Detached_AssetsLoader_Base
{
    /**
     * The settings object
     *
     * @var Prism_Detached_Settings
     */
    private $settings;


    /**
     * The file system path to the cache dir
     *
     * @var string
     */
    private $cacheDir;


    /**
     * The plugin's base dir
     *
     * @var string
     */
    private $cacheWebPath;


    /**
     * Flag, whether the cached assets loader is available
     *
     * @var bool
     */
    private $isAvailable = false;



    /**
     * Constructs a new assets loader
     *
     * @param Prism_Detached_Extension_Loader $extensionLoader
     * @param Prism_Detached_Settings $settings
     * @param string $pluginMainControllerFile
     */
    public function __construct (Prism_Detached_Extension_Loader $extensionLoader, Prism_Detached_Settings $settings, $pluginMainControllerFile)
    {
        parent::__construct($extensionLoader);
        $this->settings = $settings;
        $this->cacheWebPath = plugins_url('cache', $pluginMainControllerFile);
        $this->cacheDir = dirname($pluginMainControllerFile) . "/cache";

        $this->prepareCacheDir();
    }



    /**
     * Prepares the cache dir and checks, whether the cached assets loader is available (= cache dir exists and is writable)
     */
    private function prepareCacheDir ()
    {
        if (is_dir($this->cacheDir))
        {
            $this->isAvailable = is_writable($this->cacheDir);
        }
        else
        {
            $baseDir = dirname($this->cacheDir);

            if (is_writable($baseDir))
            {
                mkdir($this->cacheDir);
                $this->isAvailable = true;
            }
        }
    }



    /**
     * Registers the assets
     */
    public function registerAssets ()
    {
        if (!$this->cacheFilesExist())
        {
            $this->regenerate();
        }

        $files = $this->settings->getCacheKeys();

        wp_enqueue_script(
            'prism-detached',
            "{$this->cacheWebPath}/{$files['js']}",
            array(),
            false,
            true
        );

        wp_enqueue_style(
            'prism-detached',
            "{$this->cacheWebPath}/{$files['css']}",
            array(),
            false,
            "all"
        );
    }



    /**
     * Returns, whether the cache files exist
     *
     * @return bool
     */
    private function cacheFilesExist ()
    {
        $cacheKeys = $this->settings->getCacheKeys();
        return is_file($this->cacheDir . "/{$cacheKeys['js']}") && is_file($this->cacheDir . "/{$cacheKeys['css']}");
    }



    /**
     * Regenerates the cache files
     */
    public function regenerate ()
    {
        if (!$this->isAvailable())
        {
            return;
        }

        $this->removeCacheFiles();
        $cacheKeys = array();

        $jsContent = $this->getJavaScriptContent();
        $cacheKeys["js"] = md5($jsContent) . ".js";
        file_put_contents("{$this->cacheDir}/{$cacheKeys['js']}", $jsContent);

        $cssContent = $this->getCssContent();
        $cacheKeys['css'] = md5($cssContent) . ".css";
        file_put_contents("{$this->cacheDir}/{$cacheKeys['css']}", $cssContent);

        $this->settings->setCacheKeys($cacheKeys);
    }



    /**
     * Removes the cache files
     */
    private function removeCacheFiles ()
    {
        $cacheKeys = $this->settings->getCacheKeys();

        if (is_file($this->cacheDir . "/{$cacheKeys['js']}"))
        {
            unlink($this->cacheDir . "/{$cacheKeys['js']}");
        }

        if (is_file($this->cacheDir . "/{$cacheKeys['css']}"))
        {
            unlink($this->cacheDir . "/{$cacheKeys['css']}");
        }
    }



    /**
     * Returns the javascript content
     *
     * @return string
     */
    private function getJavaScriptContent ()
    {
        $extensions = $this->extensionLoader->getActiveExtensions();
        $content = "";

        if (!empty($extensions))
        {
            foreach ($extensions as $extension)
            {
                foreach ($extension->getJavascript() as $js)
                {
                    $content .= "/* {$extension->getName()} */" . PHP_EOL;
                    // semicolon is needed, since some minified javascripts omit the last ; - but the different
                    // files need to be separated (and multiple ;;; do not matter)
                    $content .= file_get_contents($extension->getFileSystemPathToExtension() . $js) . ";" . PHP_EOL . PHP_EOL;
                }
            }
        }

        return trim($content);
    }



    /**
     * Returns the CSS content
     *
     * @return string
     */
    private function getCssContent ()
    {
        $extensions = $this->extensionLoader->getActiveExtensions();
        $content = "";

        if (!empty($extensions))
        {
            foreach ($extensions as $extension)
            {
                foreach ($extension->getCss() as $css)
                {
                    $content .= "/* {$extension->getName()} */" . PHP_EOL;
                    $content .= file_get_contents($extension->getFileSystemPathToExtension() . $css) . PHP_EOL . PHP_EOL;
                }
            }
        }

        return trim($content);
    }



    public function isAvailable ()
    {
        return $this->isAvailable;
    }
}