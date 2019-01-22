<?php

/**
 * THIS FILE IS FOR BACKWARDS COMPATIBLITY ONLY
 *
 * If you were not already including this file in your project, please ignore it
 */

function google_api_php_client_autoload($className) {
    $classPath = explode('_', $className);
    if ($classPath[0] != 'Google') {
        return;
    }
    if (count($classPath) > 3) {
        // Maximum class file path depth in this project is 3.
        $classPath = array_slice($classPath, 0, 3);
    }
    array_shift($classPath);
    $filePath = dirname(__FILE__) . '/' . implode('/', $classPath) . '.php';

    if (file_exists($filePath)) {
        require_once($filePath);
    }
}

spl_autoload_register('google_api_php_client_autoload');