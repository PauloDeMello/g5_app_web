<?php

namespace App\Controllers;

class Admin extends RenderController
{
    public function index(): string
    {
        if(!auth()->user()->inGroup('admin'))
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('admin');
    }

}