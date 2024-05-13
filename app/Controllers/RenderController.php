<?php


namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class RenderController extends BaseController
{
    public function render_page($view,$data)
    {
        echo view('templates/header', $data);
        echo view($view, $data);
        echo view('templates/footer', $data);
    } 

    public function render_html_page($view,$data)
    {
        echo view('templates/header', $data);
        echo view($view . ".html", $data);
        echo view('templates/footer', $data);
    } 
}