<?php
declare(strict_types=1);

namespace Ledz\LoginPHP\Controller;

use Ledz\LoginPHP\Interface\Controller;

abstract class HTMLController implements Controller
{
    private const VIEW_PATH = __DIR__ . '/../../views/';

    public function render(string $template_name, array $context = []): void
    {
        extract($context);
        require_once self::VIEW_PATH . $template_name . '.php';
    }
}
