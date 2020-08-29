<?php declare(strict_types=1);

class ErrorController extends BaseController
{
    public function NotFound404()
    {
        $this->title = "404 Not found";
        return $this->title;
    }
}