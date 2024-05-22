<?php

namespace App\Controllers;

use CodeIgniter\Shield\Traits\Viewable;
use App\Models\AnnouncementModel;

class Admin extends BaseController
{
    use Viewable;  
    
    public function index(): string
    {
        if(!auth()->user()->inGroup('admin'))
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }


        return $this->view(setting('Admin.views')['admin']);
    }

}