<?php
declare(strict_types=1);

use Ledz\LoginPHP\Controller\HomepageController;
use Ledz\LoginPHP\Controller\LoginController;
use Ledz\LoginPHP\Controller\LogoutController;
use Ledz\LoginPHP\Controller\RegisterController;

return [
    'GET|/' => [HomepageController::class, 'processRequest'],
    'GET|/login' => [LoginController::class, 'processRequest'],
    'POST|/login' => [LoginController::class, 'authenticate'],
    'GET|/register' => [RegisterController::class, 'processRequest'],
    'POST|/register' => [RegisterController::class, 'register'],
    'GET|/logout' => [LogoutController::class, 'processRequest'],
];
