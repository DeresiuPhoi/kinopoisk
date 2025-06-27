<?php

namespace App\Kernel\View;

use App\Kernel\Exceptions\ViewNotFoundException;

class View
{
    public function component(string $name): void
    {
        extract([
            'view' => $this
        ]);
        $componentPath = APP_PATH . "/views/components/$name.php";
        if (!file_exists($componentPath)) {
            echo "Component $name not found";
            return;
        }
        include_once $componentPath;
    }

    public function page(string $name): void
    {

        $viewPath = APP_PATH . "/views/pages/$name.php";
        if (!file_exists($viewPath)) {
            throw new ViewNotFoundException("View $name not found");
        }
        extract([
            'view' => $this
        ]);

        include_once $viewPath;

    }
}