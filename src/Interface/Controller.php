<?php
declare(strict_types=1);

namespace Ledz\LoginPHP\Interface;

interface Controller
{
    public function processRequest(): void;
}