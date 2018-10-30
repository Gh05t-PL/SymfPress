<?php

namespace App\Utils;

use Symfony\Component\Routing\RouteCollection;

class RouteAnalyzer
{
    private $routeCollection;

    public function __construct(RouteCollection $routeCollection)
    {
        $this->routeCollection = $routeCollection;
    }


    /**
     * @param string $path eg. "/gallery/max21"
     * @return bool
     */
    public function isValid(string $path)
    {

        foreach ($this->routeCollection as $key => $value)
        {
            $pattern = $this->getRouteRegex($key);

            if ( preg_match($pattern, $path) == 1 )
            {
                return true;
            }
        }
        return false;
    }

    public function search()
    {

    }

    public function getRouteRegex(string $routeName)
    {
        $route = $this->routeCollection->get($routeName);

        $route = $route->compile();
        //echo $route->getRegex();
        $patterns = [
            "/\#\^/",
            "/\#sD/",
            "/([^\\\])(\/)/"
        ];
        $replacements = [
            "^",
            "",
            "$1\/"
        ];
        return  ("/" . preg_replace($patterns, $replacements, $route->getRegex()) . "/");
    }
}