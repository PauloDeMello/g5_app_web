<?php

namespace App\Controllers;

class Home extends RenderController
{
    public function index()
    {
        $name = auth()->user()->name;
        $class = auth()->user()->class;
        $data = ['name' => $name, 'class' => $class];

        if(auth()->user()->inGroup('admin'))
        {
            echo "user is admin";
            return redirect('admin');
        }

        $this->render_page('home', $data);
    }
}
