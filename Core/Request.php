<?php

Namespace Core;

class Request
{
    public $POST;
    public $GET;

    public function __construct()
    {
        $this->POST = $this->secure($_POST);
        $this->GET = $this->secure($_GET);
    }

    public function secure($request)
    {
        foreach($request as $key => $value)
        {
            $request[$key] = htmlspecialchars(strip_tags(stripslashes(trim($value))));
        }
        return $request;

    }
}