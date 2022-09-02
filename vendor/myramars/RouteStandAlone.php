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
     * @param string url path
     * @param string viewFolder Folder in views faked as controller name
     * @param string standaloneTemplateName View name in views
     * @param ContextMetadata metadata Set page title and SEO
     * @param string name Route name used for routing as name
     * @param string sitemapPriority
     */
    public function __construct(string $urlPath,
        string $viewFolder,
        string $standaloneTemplateName,
        ContextMetadata $metadata = null,
        string $name = null,
        string $sitemapPriority = '1.0')
    {
        $this->path = $urlPath;
        $this->controller = $viewFolder;
        $this->sitemapPriority = $sitemapPriority;
        $this->isStandalone = true;
        $this->standaloneTemplateName = $standaloneTemplateName;
        $this->standalonePageMetadata = $metadata;

        if(!empty($name))
            $this->name = $name;
    }
}