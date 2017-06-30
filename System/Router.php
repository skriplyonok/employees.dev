<?php

/**
 * Class System_Router
 */
class System_Router
{
    /**
     * Путь к файлу
     * @var string
     */
    private $_path;

    /**
     *
     * @param string $path
     * @throws Exception
     */
    public function setPath($path)
    {

        $path = trim($path, '/\\');
        $path .= DS;

        if (!is_dir($path)) {
            throw new Exception ('Invalid controller path: \'' . $path . '\'');
        }

        $this->_path = $path;
    }

    /**
     * Анализирует строку запроса, подгружает файл с нужным классом
     * @throws Exception
     */
    public function start()
    {
        // Анализируем путь
        $this->_getController($file, $controllerName, $actionName, $args);

        // Файл доступен?
        if (!is_readable($file)) {
            throw new Exception('404 error! Page not found');
        }

        // Подключаем файл
        include_once $file;

        // Создаём экземпляр контроллера
        $class = 'Controller_' . $controllerName;
        $action = $actionName . 'Action';

        $controller = new $class();
        $controller->setArgs($args);

        // Действие доступно?
        if (!is_callable(array($controller, $action))) {
            throw new Exception('404 error! Page not found');
        }

        call_user_func(array($controller, $action));

        /**
         * @var System_View $view
         */
        $view = $controller->view;

        $layoutFileName = 'View' . DS . 'layout.phtml';

        $contentFileName = 'View' . DS . $controllerName . DS . $actionName . '.phtml';

        include $layoutFileName;
    }


    /**
     * @param $file
     * @param $controllerName
     * @param $actionName
     * @param $args
     */
    private function _getController(&$file, &$controllerName, &$actionName, &$args)
    {
         $route = empty($_GET['route']) ? 'Index' : $_GET['route'];

        // Получаем раздельные части
        $route = trim($route, '/\\');
        $parts = explode('/', $route);

        $args = [];

        // Находим контроллер
        $cmd_path = $this->_path;
        foreach ($parts as $part) {
            $fullpath = $cmd_path . ucfirst($part);

            // Проверка существования папки
            if (is_dir($fullpath)) {
                $cmd_path .= $part . DS;
                continue;
            }

            // Находим файл
            if (is_file($fullpath . '.php')) {
                $controllerName = ucfirst($part);
                continue;
            }


            $class = 'Controller_' . $controllerName;
            // Действие доступно?
            if (is_callable(array(new $class(), $part . 'Action'))) {
                $actionName = $part;
                continue;
            }
            $args[] = $part;
        }
        // если урле не указан контролер, то испольлзуем поумолчанию index
        if (empty($controllerName)) {
            $controllerName = 'Index';
        }
        if (empty($actionName)) {
            $actionName = 'index';
        }
        $file = $cmd_path . $controllerName . '.php';
    }
}