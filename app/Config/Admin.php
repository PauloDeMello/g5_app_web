<?php

namespace Config;

class Admin
{
    
public array $views = [
        'admin'                       => '\App\Views\Admin\admin',
        'announcements'               => '\App\Views\Admin\announcements',
        'header'                      => '\App\Views\Admin\templates\header',
        'footer'                      => '\App\Views\Admin\templates\footer',
    ];

}