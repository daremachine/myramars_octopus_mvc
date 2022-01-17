<?php declare(strict_types=1);
/**
 * Myramars Octopus MVC
 * Feel free contact me Jakub Hantak<info@myramars.cz>
 * @License MIT
 */

class Request
{
    /**
     * Is Method type
     *
     * @param RequestTypeEnum method
     */
    public function isMethod(string $method): bool
    {
        if(!($method != RequestTypeEnum::GET || $method != RequestTypeEnum::POST))
            throw new Exception("Request method is not in RequestTypeEnum");
            
        return $_SERVER['REQUEST_METHOD'] == $method;
    }

    /**
     * Is GET method helper
     */
    public function isGet(): bool
    {
        return $this->isMethod(RequestTypeEnum::GET);
    }

    /**
     * Is POST method helper
     */
    public function isPost(): bool
    {
        return $this->isMethod(RequestTypeEnum::POST);
    }

    /**
     * Get GET parameter
     *
     * @param string parameterName
     */
    public function getParameter(string $parameterName): ?string
    {
        return $_GET[$parameterName] ?? null;
    }

    /**
     * Get POST parameter
     *
     * @param string parameterName
     */
    public function postParameter(string $parameterName): ?string
    {
        return $_POST[$parameterName] ?? null;
    }

    /**
     * Get POST data
     */
    public function getPostData(): \stdClass
    {
        return (object) $_POST;
    }
}

class RequestTypeEnum
{
    const GET = 'GET';
    const POST = 'POST';
}