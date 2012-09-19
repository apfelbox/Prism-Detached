<?php

/**
 * Loads all extensions
 */
class Prism_Detached_Extension_Loader
{
    /**
     * The file system path to the extension directory
     *
     * @var string
     */
    private $extensionDirectory;


    /**
     * The web path to the extension directory
     *
     * @var string
     */
    private $extensionWebPath;



    /**
     * The loaded extensions
     *
     * @var Prism_Detached_Extension_Base[]
     */
    private $extensions = null;


    /**
     * The prism settings
     *
     * @var Prism_Detached_Settings
     */
    private $settings;



    /**
     * Constructs a new extension loader
     *
     * @param string $extensionDirectory
     * @param string $extensionWebPath
     * @param Prism_Detached_Settings $settings
     *
     * @throws InvalidArgumentException
     * @internal param string $extensionDirectory
     */
    public function __construct ($extensionDirectory, $extensionWebPath, Prism_Detached_Settings $settings)
    {
        if (!is_dir($extensionDirectory))
        {
            throw new InvalidArgumentException("Cannot find extension dir.");
        }

        $this->extensionDirectory = $extensionDirectory;
        $this->extensionWebPath   = $extensionWebPath;
        $this->settings = $settings;
    }



    /**
     * Fetches the extensions
     */
    private function fetchExtensions ()
    {
        $this->loadExtensions();
        $this->sortExtensions();
        $this->markStoredActiveExtensions();
    }



    /**
     * Loads all extensions
     */
    private function loadExtensions ()
    {
        $directoryIterator = new DirectoryIterator($this->extensionDirectory);

        foreach ($directoryIterator as $dir)
        {
            /** @var $dir DirectoryIterator */
            if ($dir->isDot() || !$dir->isDir())
            {
                continue;
            }

            $this->loadSingleExtension($dir);
        }
    }



    /**
     * Loads a single extension
     *
     * @param DirectoryIterator $dir
     */
    private function loadSingleExtension (DirectoryIterator $dir)
    {
        $extensionDir = $dir->getPathname();
        $extensionClass = "Prism_Detached_Extension_{$dir->getBasename()}";
        $classFilePath = $extensionDir . "/{$extensionClass}.php";

        // check, whether class file exists
        if (!is_file($classFilePath)) return;

        // load class
        require_once $classFilePath;

        $extensionPath = "{$dir->getPathname()}/";
        $extensionUrl  = "{$this->extensionWebPath}/{$dir->getBasename()}/";

        $this->addExtension(new $extensionClass($extensionPath, $extensionUrl, $this->settings->getTheme()));
    }



    /**
     * Adds a single extension
     *
     * @param Prism_Detached_Extension_Base $extension
     */
    private function addExtension (Prism_Detached_Extension_Base $extension)
    {
        $this->extensions[] = $extension;
    }



    /**
     * Sorts the extensions
     */
    private function sortExtensions ()
    {
        $sortFunction = function (Prism_Detached_Extension_Base $ext1, Prism_Detached_Extension_Base $ext2)
        {
            return $ext1->getSortOrder() - $ext2->getSortOrder();
        };

        usort($this->extensions, $sortFunction);
    }



    /**
     * Marks stored active extensions
     */
    private function markStoredActiveExtensions ()
    {
        $settings = new Prism_Detached_Settings();
        $this->markActiveExtensions($settings->getActiveExtensions());
    }



    /**
     * Returns the available extensions
     *
     * @return Prism_Detached_Extension_Base[]
     */
    public function getAllExtensions ()
    {
        if (is_null($this->extensions))
        {
            $this->fetchExtensions();
        }

        return $this->extensions;
    }



    /**
     * Marks the given extensions as active or inactive
     *
     * @param array $extensionList structure: key => extension id, value => is active (not set = not active)
     */
    public function markActiveExtensions (array $extensionList)
    {
        $extensions = $this->getAllExtensions();

        if (!empty($extensions))
        {
            foreach ($extensions as $extension)
            {
                $isActive = isset($extensionList[$extension->getId()]) && $extensionList[$extension->getId()];
                $extension->setIsActive($isActive);
            }
        }
    }



    /**
     * Returns the active extensions
     *
     * @return array
     */
    public function getExtensionsStates ()
    {
        $extensionStates = array();
        $extensions = $this->getAllExtensions();

        if (!empty($extensions))
        {
            foreach ($extensions as $extension)
            {
                $extensionStates[$extension->getId()] = $extension->isActive();
            }
        }

        return $extensionStates;
    }



    /**
     * Returns the active extensions
     *
     * @return Prism_Detached_Extension_Base[]
     */
    public function getActiveExtensions ()
    {
        $activeExtensions = array( $this->getCore() );
        $allExtensions = $this->getAllExtensions();

        if (!empty($allExtensions))
        {
            foreach ($allExtensions as $extension)
            {
                if ($extension->isActive())
                {
                    $activeExtensions[] = $extension;
                }
            }
        }

        return $activeExtensions;
    }



    /**
     * Returns the core
     *
     * @return Prism_Detached_Extension_Core
     */
    private function getCore ()
    {
        $corePath = dirname($this->extensionDirectory) . "/prism";
        $coreUrl = $this->extensionWebPath . '/../prism';

        $core = new Prism_Detached_Extension_Core($corePath, $coreUrl, $this->settings->getTheme());
        $core->setIsActive(true);
        return $core;
    }
}