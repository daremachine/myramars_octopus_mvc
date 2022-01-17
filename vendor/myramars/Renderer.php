<?php declare(strict_types=1);
/**
 * Myramars Octopus MVC
 * Feel free contact me Jakub Hantak<info@myramars.cz>
 * @License MIT
 */

class Renderer
{
    /**
     * @param Context context
     */
    private $_context = null;
    
    /**
     * Contructor 
     *
     * @param mixed data
     */
    public function __construct(Context $context)
    {
        $this->context = $context;
    }
    
    /**
     * Render template
     *
     * @param mixed data
     */
    private function _renderTemplate($context): void
    {
        $layoutPath = $_SERVER["DOCUMENT_ROOT"] . AppConfig::$DOCUMENT_ROOT . $context->layoutPath . '/' . $context->layoutFile . '.phtml';

        if(!file_exists($layoutPath))
            throw new TemplateNotFoundException("Failed opening {$layoutPath}. Layout not found.");

        ob_start();
        include($layoutPath);
        $var=ob_get_contents(); 
        ob_end_clean();
        echo $var;
    }
    
    public function render(): void
    {
        $this->_renderTemplate($this->context);
    }
}