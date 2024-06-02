<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ProfileModel;

use CodeIgniter\Files\File;

class Profile extends ResourceController
{
    protected $model;
    // There used to be a bug in version 4.0.2 now fixed in v4.0.3. No issues in json return
    protected $format    = 'json';

    protected $helpers = ['form'];

    protected $kyuBeltPair = 
    ['Yellow Tag' => '6th',
    'Yellow' => '6th',
    'Orange Tag' => '5th',
    'Orange' => '5th',
    'Green Tag' => '4th',
    'Green' => '4th',
    'Purple Tag' => '3rd',
    'Purple' => '3rd',
    'Blue Tag' => '2nd',
    'Blue' => '2nd',
    'Brown Tag' => '1st',
    'Brown Double Tag' => '1st',
    'Brown' => '1st',
    'Black Tag' => 'Black Belt',
    'Black Double Tag' => 'Black Belt',
    'Black' => 'Black Belt'];
	
    
    // Prefered way
    public function __construct()
    {
        $this->model  = new ProfileModel();
    }

    public function index()
    {

        echo view('templates/header', );
        echo view('profile', ['errors' => []]);
        echo view('templates/footer', );
    }

    public function getIndex()
    {
        //TODO: Set up correct belt -> Syllabus
        $userID = auth()->user()->username;
        $this->model->SetupProfileModel($userID);
        $belt = auth()->user()->belt;
        $name = auth()->user()->name;
        $class = auth()->user()->class;
        $data = ['name' => $name, 'belt_grades' => $this->model->belt_grades, 'beltName' => $belt, 'class' => $class];
        return $this->respond($data);
    }

}