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

        // create controller instance
        $controllerNameClass = ucfirst($route->controller . 'Controller');
        $actionName = $route->action;
        $controller = new $controllerNameClass(new Request());

        if(!$controller instanceof BaseController)
            throw new Exception("Controller {$controllerNameClass} found but is not instance of BaseController. It must be derivered from BaseController.");

        $data = $controller->$actionName();

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
            . strtolower($route->action)
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
}