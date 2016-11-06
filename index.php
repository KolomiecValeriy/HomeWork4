<?php

error_reporting(E_ALL);
require_once __DIR__.'/vendor/autoload.php';
/**
 *	$config = array(
 *  'db' => 'study',
 *  'user' => 'username',
 *  'password' => 'password',
 *	);.
 */
require_once 'config.php';

if (!isset($_GET['page']) || $_GET['page'] == 'menu') {
    require 'src/Pages/menu.php';
} elseif ($_GET['page'] == 'show') {
    require 'src/Pages/show.php';
}

    isset($_GET['action']) ? $action = $_GET['action'] : $action = false;

    $controller = new Controllers\Controller($config);
    if ($action == 'new_structure') {
        $controller->createStructure();
    }
    if ($action == 'generate_data') {
        $controller->generateData();
    }
