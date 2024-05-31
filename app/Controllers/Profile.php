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

    public function getImage()
    {
        $userID = auth()->user()->username;
        $filename = "{$userID}.webp";
        $example_filename = "example.webp";
        $filepath = WRITEPATH . 'uploads/avatar/';
        $example_full_filepath = $filepath . $example_filename;
        $full_filepath = $filepath . $filename;
        if(file_exists($full_filepath))
        {
            $mime = mime_content_type($full_filepath); //<-- detect file type
            header('Content-Length: '.filesize($full_filepath)); //<-- sends filesize header
            header("Content-Type: $mime"); //<-- send mime-type header
            header('Content-Disposition: inline; filename="'.$filename.'";'); //<-- sends filename header
            readfile($full_filepath); //<--reads and outputs the file onto the output buffer
            exit(); // or die()
        }

        $mime = mime_content_type($example_full_filepath); //<-- detect file type
        header('Content-Length: '.filesize($example_full_filepath)); //<-- sends filesize header
        header("Content-Type: $mime"); //<-- send mime-type header
        header('Content-Disposition: inline; filename="'.$example_filename.'";'); //<-- sends filename header
        readfile($example_full_filepath); //<--reads and outputs the file onto the output buffer
        exit(); // or die()
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
                    'max_size[userfile,10240]',
                ],
            ],
        ];
        if (! $this->validateData([], $validationRule)) {
            $data = ['errors' => $this->validator->getErrors()];

            echo view('templates/header', );
            echo view('profile', $data);
            echo view('templates/footer', );
            return;
        }

        $img = $this->request->getFile('userfile');

        if (! $img->hasMoved()) {

            $img = \Config\Services::image('gd')->withFile($img);
            
            $img->fit(100, 100);
            $img->reorient();
            $img->convert(IMAGETYPE_WEBP);
            
            $userID = auth()->user()->username;
 
            
            $ext = $img->guessExtension();
            $filename = "{$userID}.webp";
                 
            $filepath = WRITEPATH . 'uploads/avatar/';
            
            #$img->move($filepath, $filename, true);
            $full_filepath = $filepath . $filename;
            $img->save($full_filepath);
            //$filepath2 = getenv('IMG_WRITEPATH') . 'uploads/';

            $data = ['uploaded_fileinfo' => new File($full_filepath)];

            return view('upload_success', $data);
        }

        $data = ['errors' => 'The file has already been moved.'];

        echo view('templates/header', );
        echo view('profile', $data);
        echo view('templates/footer', );
        return;
    }
}
