<?php declare(strict_types=1);
/**
 * Myramars Octopus MVC
 * Feel free contact me Jakub Hantak<info@myramars.cz>
 * @License MIT
 */

/**
 * Route
 */
class RouteStandAlone extends Route
{
    /**
     * Controller
     *
     * @param string path
     * @param string controller
     * @param string viewFolder folder in views
     * @param string standaloneTemplateName view name in views
     * @param string pageTitle set page title
     * @param string name route name used for routing as name
     * @param string sitemapPriority
     */
    public function __construct(string $path,
        string $viewFolder,
        string $standaloneTemplateName,
        string $pageTitle = null,
        string $name = null,
        string $sitemapPriority = '1.0')
    {
        $this->path = $path;
        $this->controller = $viewFolder;
        $this->sitemapPriority = $sitemapPriority;
        $this->isStandalone = true;
        $this->standaloneTemplateName = $standaloneTemplateName;
        $this->standalonePageTitle = $pageTitle;

        if(!empty($name))
            $this->name = $name;
    }
}