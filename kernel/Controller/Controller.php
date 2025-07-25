<?php

namespace App\Kernel\Controller;

use App\Kernel\Http\Request;
use App\Kernel\View\View;

abstract class Controller
{
    private View $view;
    private Request $request;

    /**
     * @return Request
     */
    public function request(): Request
    {
        return $this->request;
    }

    /**
     * @param Request $request
     */
    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function view($name): void
    {
        $this->view->page($name);
    }

    public function setView(View $view):void
    {
        $this->view = $view;
    }
}