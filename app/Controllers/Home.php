<?php

namespace App\Controllers;

class Home extends RenderController
{
    public function index()
    {
        $name = auth()->user()->name;
        $class = auth()->user()->class;
        $data = ['name' => $name, 'class' => $class];
        $this->render_page('home', $data);
    }
}
