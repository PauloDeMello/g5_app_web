<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\BeltModel;

class Syllabus extends ResourceController
{
    protected $model;
    // There used to be a bug in version 4.0.2 now fixed in v4.0.3. No issues in json return
    protected $format    = 'json';

    protected $syllabusBeltPairs = 
    ['White' => ['Yellow Tag', 'Yellow'], 
    'Yellow Tag' => ['Yellow Tag', 'Yellow'],
    'Yellow' => ['Orange Tag', 'Orange'],
    'Orange Tag' => ['Orange Tag', 'Orange'],
    'Orange' => ['Green Tag', 'Green'],
    'Green Tag' => ['Green Tag', 'Green'],
    'Green' => ['Purple Tag', 'Purple'],
    'Purple Tag' => ['Purple Tag', 'Purple'],
    'Purple' => ['Blue Tag', 'Blue'],
    'Blue Tag' => ['Blue Tag', 'Blue'],
    'Blue' => ['Brown Tag', 'Brown Double Tag', 'Brown'],
    'Brown Tag' => ['Brown Tag', 'Brown Double Tag', 'Brown'],
    'Brown Double Tag' => ['Brown Tag', 'Brown Double Tag', 'Brown'],
    'Brown' => ['Black Tag', 'Black Double Tag', 'Black'],
    'Black Tag' => ['Black Tag', 'Black Double Tag', 'Black'],
    'Black Double Tag' => ['Black Tag', 'Black Double Tag', 'Black'],
    'Black' => ['Black']];
	
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
        //TODO: Set up correct belt -> Syllabus
        $belt = auth()->user()->belt;
        $syllabusBelts = $this->syllabusBeltPairs[$belt];
        $this->model->SetupBeltModel($belt, $syllabusBelts);
        $name = auth()->user()->name;
        $class = auth()->user()->class;
        $data = ['name' => $name, 'syllabus' => $this->model->syllabus, 'beltName' => $this->model->belt, 'class' => $class];
        return $this->respond($data);
    }

    public function getPreviousSyllabus()
    {
        //TODO: Set up correct belt -> Syllabus
        $belt = auth()->user()->belt;
        $syllabusBelts = $this->syllabusBeltPairs[$belt];
        $this->model->SetupBeltModel($syllabusBelts);
        $name = auth()->user()->name;
        $class = auth()->user()->class;
        $data = ['name' => $name, 'syllabus' => $this->model->syllabus, 'beltName' => $this->model->belt, 'class' => $class];
        return $this->respond($data);
    }
}
