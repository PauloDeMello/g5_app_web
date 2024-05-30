<?php

namespace App\Controllers;

class Offline extends BaseController
{ 
    
    public function index(): string
    {
        return view("offline.html");
    }

}