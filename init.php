<?php
require_once "constants.php";
require_once "core/procedures.php";

setEnv();

spl_autoload_register(function($className)
{
    $namespace=str_replace("\\","/",__NAMESPACE__);
    $className=str_replace("\\","/",$className);
    $class= "/".(empty($namespace)?"":$namespace."/")."{$className}.class.php";
    include_once($class);
});
