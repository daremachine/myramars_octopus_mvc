<?php declare(strict_types=1);
/**
 * Myramars Octopus MVC
 * Feel free contact me Jakub Hantak<info@myramars.cz>
 * @License MIT
 */

class RobotLoader
{
    public static $PATHS = ['vendor', 'models', 'viewmodels'];

    public static $EXCLUDED_FILES = ['.', '..', 'RobotLoader.php', 'AlphaAuthorizationLoginPage.php'];
    
    public static function load($folders = null, $path = null)
    {
        // load web application settings
        if($folders == null) {
            require_once("../wwwroot/config.php");
            AppConfig::init();
        }

        // set first iteration add absolute folder path
        $firstIterationPath = ($folders == null) ? $_SERVER['DOCUMENT_ROOT'] . AppConfig::$DOCUMENT_ROOT : "";

        foreach(($folders ?? self::$PATHS) as $folder)
        {
            if(in_array($folder, self::$EXCLUDED_FILES)) continue;

            if(strpos(AppConfig::$DOCUMENT_ROOT . $folder, '.php')) {
                require_once("{$path}/{$folder}");
            }
            else {
                $folderPath = ($path == null) ? $folder : "{$path}/{$folder}";
                $folderPath = ($firstIterationPath != null) ? $firstIterationPath . $folderPath : $folderPath;
                $firstIterationPath = null;

                if(!file_exists($folderPath))
                    throw new Exception("AppConfig::DOCUMENT_ROOT in config.php is probably wrong. Please set right application path from document_root. Current path: {$folderPath}");

                // debug files
                if(AppConfig::$LOADER_DEBUG) {
                    var_dump('-- ' . $folder . ' -- loaded ------------------------------');
                    var_dump($folderPath);
                    var_dump('<pre>');
                    var_dump(scandir($folderPath));
                    var_dump('/<pre>');
                }

                self::load(scandir($folderPath), $folderPath);
            }

            // set first iteration add absolute folder path after each folder
            $firstIterationPath = ($folders == null) ? $_SERVER['DOCUMENT_ROOT'] . AppConfig::$DOCUMENT_ROOT : "";
        }
    }
}