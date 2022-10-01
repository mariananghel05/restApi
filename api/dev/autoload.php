<?php
//_____________Autoload Function_____________\\
spl_autoload_register(function ($class_name) {
    include_once(Config::$composer->autoload->$class_name);   
});