<?php
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
            throw new Exception('404 error! Controller ' . '\'' . $controllerName . '\''. ' not found');
        }

        // Подключаем файл
        include_once $file;

        // Создаём экземпляр контроллера
        $class = 'Controller_' . $controllerName;
        $action = $actionName . 'Action';

        $controller = new $class($action);
        $controller->setArgs($args);

        // Действие доступно?
        if (!is_callable(array($controller, $action))) {
            throw new Exception('404 error. Action ' . '\'' . $action . '\''. ' Not Found');
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
     *
     * @param string $file
     * @param string $controller
     * @param string $actionName
     * @param string $args
     */
    private function _getController(&$file, &$controller, &$actionName, &$args)
    {
         $route = empty($_GET['route']) ? 'index' : $_GET['route'];

        // Получаем раздельные части
        $route = trim($route, '/\\');
        $parts = explode('/', $route);

        // Находим контроллер
        $cmd_path = $this->_path;
        foreach ($parts as $part) {
            $fullpath = $cmd_path . $part;

            // Проверка существования папки
            if (is_dir($fullpath)) {
                $cmd_path .= $part . DS;
                array_shift($parts);
                continue;
            }

            // Находим файл
            if (is_file($fullpath . '.php')) {
                $controller = $part;
                array_shift($parts);
                break;
            }
        }

        // если урле не указан контролер, то испольлзуем поумолчанию index
        if (empty($controller)) {
            $controller = 'index';
        }

        // Получаем экшен
        $actionName = array_shift($parts);
        if (empty($actionName)) {
            $actionName = 'index';
        }

        if (is_numeric($actionName)){
            $args = [$actionName];
            $actionName = 'index';
        }

        $file = $cmd_path . $controller . '.php';
//        $args = $parts;
    }
}