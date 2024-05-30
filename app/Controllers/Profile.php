<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ProfileModel;

class Profile extends ResourceController
{
    protected $model;
    // There used to be a bug in version 4.0.2 now fixed in v4.0.3. No issues in json return
    protected $format    = 'json';
    
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
        $id = auth()->user()->id;
        $this->model->SetupProfileModel($id);
        $belt = auth()->user()-belt;
        $name = auth()->user()->name;
        $class = auth()->user()->class;
        $data = ['name' => $name, 'belt_grades' => $this->model->belt_grades, 'beltName' => $this->model->belt, 'class' => $class];
        return $this->respond($data);
    }

    public function getImage()
    {

    }

    public function upload()
    {
        $validationRule = [
            'userfile' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[userfile]',
                    'is_image[userfile]',
                    'mime_in[userfile,image/jpg,image/jpeg,image/png,image/webp]',
                    'max_size[userfile,100]',
                    'max_dims[userfile,1024,768]',
                ],
            ],
        ];
        if (! $this->validateData([], $validationRule)) {
            $data = ['errors' => $this->validator->getErrors()];

            return view('upload_form', $data);
        }

        $img = $this->request->getFile('userfile');

        if (! $img->hasMoved()) {
            $filepath = WRITEPATH . 'uploads/' . $img->store();

            $data = ['uploaded_fileinfo' => new File($filepath)];

            return view('upload_success', $data);
        }

        $data = ['errors' => 'The file has already been moved.'];

        return view('upload_form', $data);
    }
}
