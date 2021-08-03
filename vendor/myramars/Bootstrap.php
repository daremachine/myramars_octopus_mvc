<?php declare(strict_types=1);
/**
 * Myramars Octopus MVC
 * Feel free contact me Jakub Hantak<info@myramars.cz>
 * @License MIT
 */

/**
 * Application run
 * 
 * @example
 * 
 * class Settings {
 *    public static $DEFAULT_LAYOUT_PATH = '/views';
 *    public static $DEFAULT_TEMPLATE_PATH = '/views';
 * }
 * 
 * $routes = new RouteList();
 * $routes->addRoute(new Route('/index/test', 'Index', 'Test'));
 * 
 * (new Bootstrap())->setRoutes($routes)->run();
 */
class Bootstrap
{
    /**
     * @param RouteList RouteList
     */
    private $_routeList = null;
    
    public function __construct()
    {
        // load controllers
        foreach (glob("{$_SERVER["DOCUMENT_ROOT"]}" . AppConfig::$DOCUMENT_ROOT . "controllers/*.php") as $filename)
        { 
            include $filename;
        }
    }

    /**
     * Run the application
     */
    public function run()
    {
        // get controller params from router
        $router = new Router($this->_routeList);

        try {
            $route = $router->getRoute();
        }
        catch(RouteNotFoundException $ex) 
        {
            $route = new Route('/error', 'Error', 'NotFound404');
        }

        // set routeList for generating links
        $helperLink = new HelperLink();
        $helperLink::$ROUTE_LIST = $this->_routeList;

        // return sitemap page
        if($route->path == '/sitemap.xml') {
            echo $this->_generateSitemap($this->_routeList);
            exit;
        }

        // if sitemap.xml not exist then create new one
        if(!file_exists(AppConfig::$DOCUMENT_ROOT . '/wwwroot/sitemap.xml')) {
            $this->_createSitemapFile($this->_generateSitemap($this->_routeList));
        }

        // return dev authorization page
        if(AppConfig::$USE_ALPHA_CLOSED_TEST && !isset($_COOKIE["AlphaClosedTestLogin"])) {
            include_once($_SERVER["DOCUMENT_ROOT"] . AppConfig::$DOCUMENT_ROOT . 'wwwroot/config.php');
            include_once($_SERVER["DOCUMENT_ROOT"] . AppConfig::$DOCUMENT_ROOT . 'vendor/myramars/AlphaAuthorizationLoginPage.php');
            exit;
        }

        // create controller instance
        $controllerNameClass = ucfirst($route->controller . 'Controller');
        $actionName = !$route->isStandalone ? $route->action : $route->standaloneTemplateName;
        $controller = new $controllerNameClass(new Request());

        if(!$controller instanceof BaseController)
            throw new Exception("Controller {$controllerNameClass} found but is not instance of BaseController. It must be derivered from BaseController.");

        $data = !$route->isStandalone ? $controller->$actionName() : null;

        if($data instanceof View) {
            $context = new Context($_SERVER["DOCUMENT_ROOT"] . AppConfig::$DOCUMENT_ROOT . Settings::$DEFAULT_TEMPLATE_PATH . '/' .$data->templatePath, $data->data, $controller->pageTitle);
            $context->setLayoutPath(Settings::$DEFAULT_LAYOUT_PATH);
            $context->setLayout($controller->layout ?? Settings::$DEFAULT_LAYOUT_FILE);
        }
        else {
            $templatePath = "{$_SERVER["DOCUMENT_ROOT"]}"
            . AppConfig::$DOCUMENT_ROOT 
            . Settings::$DEFAULT_TEMPLATE_PATH 
            . "/"
            . strtolower($route->controller)
            . "/"
            . strtolower($actionName)
            . ".phtml";
            $context = new Context($templatePath, $data, $controller->pageTitle);
            $context->setLayoutPath(Settings::$DEFAULT_LAYOUT_PATH);
            $context->setLayout($controller->layout ?? Settings::$DEFAULT_LAYOUT_FILE);
        }

        // render layout with template
        (new Renderer($context))->render();
        exit;
    }

    /**
     * Set routes
     *
     * @param RouteList RouteList
     */
    public function setRoutes(RouteList $routeList)
    {
        $this->_routeList = $routeList;
        
        return $this;
    }

    /**
     * Generate sitemap
     *
     * @return string xml
     */
    private function _generateSitemap($routes)
    {
        // xml sitemap skeleton
        $string = <<<XML
            <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
            </urlset>
        XML;

        $xml = new SimpleXMLElement($string);

        foreach($routes->getRoutes() as $route) {
            if($route->controller == 'Home' && $route->action == 'Index') continue;

            $a = $xml->addChild('url');
            $a->addChild('loc', 'https://' . AppConfig::$WEB . $route->path);
            $a->addChild('changefreq', 'monthly');
            $a->addChild('priority', $route->sitemapPriority);
        }

        $xmlDocument = new DOMDocument('1.0');
        $xmlDocument->preserveWhiteSpace = false;
        $xmlDocument->formatOutput = true;
        $xmlDocument->loadXML($xml->asXML());

        $result =  $xmlDocument->saveXML();

        return $result;
    }

    /**
     * Create sitemap xml file
     */
    private function _createSitemapFile($content) 
    {
        $fp = fopen($_SERVER["DOCUMENT_ROOT"] . AppConfig::$DOCUMENT_ROOT . 'wwwroot/sitemap.xml', 'wb');
        fwrite($fp, $content);
        fclose($fp);
    }
}