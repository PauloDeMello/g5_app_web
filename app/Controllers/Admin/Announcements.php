<?php

namespace App\Controllers\Admin;

use CodeIgniter\Shield\Traits\Viewable;
use App\Models\AnnouncementModel;
use App\Controllers\BaseController;

class Announcements extends BaseController
{
    use Viewable;  
    
    public function index(): string
    {
        if(!auth()->user()->inGroup('admin'))
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if (isset($_POST['submit']))
        {
            $annoucementModel = new AnnouncementModel();
            $isSuccessful = $annoucementModel->PostAnnouncement($_POST['title'], $_POST['message']);

            if($isSuccessful)
            {
                echo "Post Successful";
            }
            else
            {
                echo "Post Failed";
            }
        }
        return $this->view(setting('Admin.views')['announcements']);
    }

}