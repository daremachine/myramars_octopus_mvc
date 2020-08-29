<?php declare(strict_types=1);
/**
 * Myramars Octopus MVC
 * Feel free contact me Jakub Hantak<info@myramars.cz>
 * @License MIT
 */

/**
 * View controller response type
 * define path of view
 */
class View
{
    /**
     * @param string templatePath
     */
    public $templatePath = null;
    
    /**
     * @param mixed data
     */
    public $data = null;

    /**
     * @param string templatePath
     * @param mixed data
     */
    public function __construct(string $templatePath, $data)
    {
        $this->templatePath = $templatePath;
        $this->data = $data;
    }
}