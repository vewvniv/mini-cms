<?php
declare(strict_types=1);

namespace Ledz\LoginPHP\Controller;

class HomepageController extends HTMLController
{
    public function processRequest(): void
    {
        $this->render('homepage');
    }
}
