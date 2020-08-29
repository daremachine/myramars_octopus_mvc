<?php declare(strict_types=1);
/**
 * Myramars Octopus MVC
 * Feel free contact me Jakub Hantak<info@myramars.cz>
 * @License MIT
 */

/**
 * Helpers
 */
class Helper
{
    /**
     * @param string currentUrl
     */
    static function getCurrentUrl()
    {
        return htmlspecialchars($_SERVER["REQUEST_URI"]);
    }
}