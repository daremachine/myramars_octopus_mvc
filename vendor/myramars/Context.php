<?php declare(strict_types=1);
/**
 * Myramars Octopus MVC
 * Feel free contact me Jakub Hantak<info@myramars.cz>
 * @License MIT
 */

class Context
{
    /**
     * @param mixed data
     */
    public $data = null;
    
    /**
     * @param string title
     */
    public $pageTitle = null;

    /**
     * @param string templatePath
     */
    public $templatePath = null;
    
    /**
     * @param string layoutPath
     */
    public $layoutPath = null;

    /**
     * @param string layoutFile
     */
    public $layoutFile = null;

    /**
     * @param mixed currentUrl
     */
    public $currentUrl = null;

    /**
     * @param mixed routePath
     */
    public $routePath = null;
    
    /**
     * Constructor
     *
     * @param string templatePath
     * @param mixed data
     * @param string pageTitle
     */
    public function __construct($templatePath, $data, $pageTitle)
    {
        $this->templatePath = $templatePath;
        $this->pageTitle = $pageTitle;
        $this->currentUrl = htmlspecialchars($_SERVER["REQUEST_URI"]);
        $this->routePath = str_replace(AppConfig::$DOMAIN, '', htmlspecialchars($_SERVER["REQUEST_URI"]));

        // data is object then set new properties to Context for easy accessibility 
        // eg. $data->form ==> $context->form instead of $context->data->form
        if(is_object($data)) {
            foreach(get_object_vars($data) as $key => $val)
            {
                $this->{$key} = $val;
            }
        }
        else {
            $this->data = $data;
        }
    }

    /**
     * Set layout path
     *
     * @param string layoutPath
     */
    public function setLayoutPath($layoutPath): void
    {
        $this->layoutPath = $layoutPath;
    }

    /**
     * Set layout file
     *
     * @param string layoutPath
     */
    public function setLayout($layoutFile)
    {
        $this->layoutFile = $layoutFile;
    }

    /**
     * Render page content
     */
    public function renderContent()
    {
        $context = $this;

        if(!file_exists($context->templatePath))
            throw new TemplateNotFoundException("Failed opening {$context->templatePath}. Template not found.");

        include($context->templatePath);
    }
}