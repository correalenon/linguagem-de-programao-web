<?php
    require_once __DIR__ . '/routeswitch.php';

    class Router extends RouteSwitch
    {
        public function run(string $requestUri)
        {
            $route = substr($requestUri, 1);

            if ($route === '') {
                $this->inicio();
            } else {
                $this->$route();
            }
        }
    }
?>