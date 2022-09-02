<?php declare(strict_types=1);
/**
 * Myramars Octopus MVC
 * Feel free contact me Jakub Hantak<info@myramars.cz>
 * @License MIT
 */

final class ContextMetadata
{
    /**
     * @param string title
     */
    public $title = null;

    /**
     * @param string decription
     */
    public $description = null;

    /**
     * @param string keywords
     */
    public $keywords = null;

    /**
     * Constructor
     *
     * @param string description
     * @param string keywords
     */
    public function __construct($title, $description = null, $keywords = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
    }
}