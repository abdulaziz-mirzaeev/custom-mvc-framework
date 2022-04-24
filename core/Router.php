<?php


namespace App\Core;



use Illuminate\Support\Facades\DB;

class Router
{

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    protected $routes = [];

    protected $notFoundCallback;

    public static $baseDir;
    /**
     * Router constructor.
     */
    public function __construct($dir)
    {
        $this->notFoundCallback = function () {
            echo 'Not Found 404';
        };

        self::$baseDir = $dir . DIRECTORY_SEPARATOR;
    }

    public function get(string $path, $callback)
    {
        $this->addRoute(self::METHOD_GET, $path, $callback);
    }

    public function post(string $path, $callback)
    {
        $this->addRoute(self::METHOD_POST, $path, $callback);
    }

    public function run()
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        $routeCallback = null;
        foreach ($this->routes as $route) {
            if ($route['path'] === $requestPath && $route['method'] === $requestMethod) {
                $routeCallback = $route['callback'];
            }
        }

        if (!$routeCallback) {
            header('HTTP/1.0 404 Not Found');
            $routeCallback = $this->notFoundCallback;
        }

        if (is_array($routeCallback)) {
            $controllerName = array_shift($routeCallback);
            $controller = new $controllerName;

            $method = array_shift($routeCallback);
            $routeCallback = [$controller, $method];
        }

        call_user_func_array($routeCallback, [
            array_merge($_GET, $_POST)
        ]);
    }

    private function addRoute(string $method, string $path, $callback)
    {
        $this->routes[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'callback' => $callback,
        ];
    }
}