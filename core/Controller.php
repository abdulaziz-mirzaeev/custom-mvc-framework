<?php


namespace App\Core;

use App\Helpers\Debug;

abstract class Controller
{
    private string $viewPath = 'views';
    private string $layout = '/layouts/main';

    public function render(string $view, array $params = [])
    {
        $content = $this->renderPartial($view, $params);
        $this->renderContent($content);
    }

    public function renderPartial(string $view, array $params = [])
    {
        extract($params);

        ob_start();
        require $this->getViewPath() . $view . '.php';
        return ob_get_clean();
    }

    private function renderContent($content)
    {
        $layoutPath = $this->getViewDir() . $this->layout . '.php';
        require_once $layoutPath;
    }

    /**
     * @return string
     */
    public function getViewPath(): string
    {
        $separator = DIRECTORY_SEPARATOR;

        return $this->getViewDir() . $this->getId() . $separator;
    }

    public function getControllerName()
    {
        $fullName = explode('\\', static::class);
        return end($fullName);
    }

    /**
     * @return string
     */
    public function getId()
    {
        $matches = [];
        $controller = preg_match_all('/[A-Z]?[a-z]+/', $this->getControllerName(), $matches);

        $matches = $matches[0];
        array_pop($matches);

        $viewDirName = '';

        foreach ($matches as $i => $match) {
            if ($i > 0) {
                $viewDirName .= '-';
            }
            $viewDirName .= strtolower($match);
        }
        return $viewDirName;
    }

    /**
     * @param string $separator
     * @return string
     */
    public function getViewDir(): string
    {
        $separator = DIRECTORY_SEPARATOR;
        return Router::$baseDir . $this->viewPath . $separator;
    }
}