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
     * @return string currentUrl
     */
    static function getCurrentUrl(): string
    {
        return htmlspecialchars($_SERVER["REQUEST_URI"]);
    }

    /**
     * @return bool is active url
     */
    static function isActiveUrl(Context $context, string $search, $successCss, string $failedCss = null): string
    {
        return strpos($context->routePath, $search) !== false ? $successCss : $failedCss;
    }
}