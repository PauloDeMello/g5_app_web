<?php

namespace App\Controllers;

use CodeIgniter\Shield\Traits\Viewable;
use App\Models\AnnouncementModel;

class Admin extends BaseController
{
    use Viewable;  
    
    public function index()
    {
        if(!auth()->user()->inGroup('admin'))
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }


        echo $this->view(setting('Admin.views')['header']);
        echo $this->view(setting('Admin.views')['admin']);
        echo $this->view(setting('Admin.views')['footer']);
    }

}