<?php

namespace App\Controllers;

use CodeIgniter\Shield\Traits\Viewable;
use CodeIgniter\RESTful\ResourceController;
use App\Models\AnnouncementModel;

class Announcements extends ResourceController
{
    use Viewable;  

    protected $model;
    // There used to be a bug in version 4.0.2 now fixed in v4.0.3. No issues in json return
    protected $format    = 'json';
	
    // Prefered way
    public function __construct()
    {
        $this->model  = new AnnouncementModel();
    }
    
    
    public function index()
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
        echo $this->view(setting('Admin.views')['header']);
        echo $this->view(setting('Admin.views')['announcements']);
        echo $this->view(setting('Admin.views')['footer']);
    }

    
    public function getIndex()
    {
        $this->model->SetupLatestAnnouncementModel();
        $title =  $this->model->title;
        $message = $this->model->messageVar;
        $timestamp = $this->model->timestampVar;
        $data = ['title' => $title, 'message' => $message, 'timestamp' => $timestamp];
        return $this->respond($data);
    }

}