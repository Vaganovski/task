<?php
namespace Core;

class Router
{
    protected $routes=[];
    
    protected $params=[];


    public function add($route, $params)
    {
        $this->routes[$route] = $params;
    }
    
    public function match($url) 
    {
        foreach ($this->routes as $key => $value) {
            if ($url == $key) {
                $this->params = $value;
                return true;
            }
            
        }
        return false;
    }
    
    public function dispatch($url)
    {
        if ($this->match($url)) {
            $controller = "App\controllers\\".str_replace(' ', '', ucwords(str_replace('-', ' ', $this->params['controller'])));            
            if (class_exists($controller)) {
                $controller_object = new $controller($this->params);
                $action = lcfirst($this->params['action']);
                if (is_callable([$controller_object, $action])) {
                    $controller_object->$action();
                } else {
                    throw new \Exception("Method $action in controller $controller not found");
                }
            } else {
                throw new \Exception("Controller class $controller not found");
            }
        } else {
            throw new \Exception('No route matched.', 404);
        }
    }
}

