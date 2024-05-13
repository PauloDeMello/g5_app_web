<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class Home extends ResourceController
{
    protected $model;
    // There used to be a bug in version 4.0.2 now fixed in v4.0.3. No issues in json return
    protected $format    = 'json';
	
    // Prefered way
    public function __construct()
    {
        $this->model  = new UserModel();
    }

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

        echo view('templates/header');
        echo view('home');
        echo view('templates/footer');
    }

    public function getIndex()
    {
        $name = auth()->user()->name;
        $class = auth()->user()->class;

        $data = ['name' => $name, 'class' => $class];

        return $this->respond($data);
    }
}
