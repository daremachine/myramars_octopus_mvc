<?php declare(strict_types=1);
/**
 * Myramars Octopus MVC
 * Feel free contact me Jakub Hantak<info@myramars.cz>
 * @License MIT
 */

class BaseController
{
    /**
     * Page title
     * 
     * @param string pageTitle
     */
    public $pageTitle = null;

    /**
     * Http request
     * 
     * @param Request request
     */
    public $request = null;

    /**
     * Constructor
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Redirect to controller action
     * 
     * @param string action
     * @param string controller
     * @param string parameters
     */
    public function redirect($action, $controller, $parameters = null)
    {
        $url = HelperLink::link($action, $controller, $parameters);
        header("Location: {$url}");
        die();
    }

    /**
     * Redirect to specific url
     * 
     * @param string url
     */
    public function redirectTo($url)
    {
        header("Location: {$url}");
        die();
    }
}