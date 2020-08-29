<?php declare(strict_types=1);
/**
 * Myramars Octopus MVC
 * Feel free contact me Jakub Hantak<info@myramars.cz>
 * @License MIT
 */

class RobotLoader
{
    public static $PATHS = ['../vendor', '../models', '../viewModels'];

    public static function load($folders = null, $path = null)
    {
        // load web application settings
        if($folders == null) require_once('../wwwroot/WebSettings.php');

        foreach(($folders ?? self::$PATHS) as $folder)
        {
            if($folder === '.' || $folder === '..' || $folder === 'RobotLoader.php') continue;

            if(strpos($folder, '.php')) {
                #var_dump("{$path}/{$folder}");
                require_once("{$path}/{$folder}");
            }
            else {
                $folderPath = ($path == null) ? $folder : "{$path}/{$folder}";
                self::load(scandir($folderPath), $folderPath);
            }
        }
    }
}