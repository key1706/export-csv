<?php
/**
 * @author TruongHV1
 */

use Controller\BaseController;

// define
define("ROOT", realpath(__DIR__));

$httpVar = explode('/', $_SERVER['SCRIPT_NAME']);

$modelName = isset($_GET['c']) ? $_GET['c'] : 'Base';
$controllerName = $modelName . "Controller";
$actionName = (isset($_GET['a']) ? $_GET['a'] : 'index') . 'Action';

// auto load
require_once ROOT . '/Controller/BaseController.php';
require_once ROOT . '/Core/ConnectionManager.php';
require_once ROOT . '/Model/AbstractModel.php';

$controllerPath = ROOT . '/Controller/' . $controllerName . '.php';
$modelPath = ROOT . '/Model/' . $modelName. '.php';
$modelInterfacePath = ROOT . '/Model/' . $modelName. 'Interface.php';

if(file_exists($modelInterfacePath)){
    require_once ($modelInterfacePath);
}

if (file_exists($modelPath)){
    require_once ($modelPath);
}

if(file_exists($controllerPath)){
    require_once ($controllerPath);
}

// instance
$controllerUse = 'Controller\\' . $controllerName;
$controller = new $controllerUse($modelName);

echo $controller->{$actionName}();
