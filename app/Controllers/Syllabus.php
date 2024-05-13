<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\BeltModel;

class Syllabus extends ResourceController
{
    protected $model;
    // There used to be a bug in version 4.0.2 now fixed in v4.0.3. No issues in json return
    protected $format    = 'json';
	
    // Prefered way
    public function __construct()
    {
        $this->model  = new BeltModel();
    }

    public function index()
    {

        echo view('templates/header', );
        echo view('syllabus', );
        echo view('templates/footer', );
    }

    public function getIndex()
    {
        $beltID = auth()->user()->belt;
        $syllabus = $this->model->ReturnSyllabusArray($beltID);
        $this->model->SetupBeltModel($beltID);
        $name = auth()->user()->name;
        $class = auth()->user()->class;
        $data = ['name' => $name, 'syllabus' => $this->model->syllabus, 'beltName' => $this->model->name, 'class' => $class];
        return $this->respond($data);
    }
}
