<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ProfileModel;

use CodeIgniter\Files\File;

class Settings extends ResourceController
{
    protected $model;
    // There used to be a bug in version 4.0.2 now fixed in v4.0.3. No issues in json return

    protected $helpers = ['form'];
    
    // Prefered way
    public function __construct()
    {
    }

    public function index()
    {

        echo view('templates/header', );
        echo view('settings', ['errors' => [], 'messages' => []]);
        echo view('templates/footer', );
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
            echo view('templates/header', );
            echo view('settings');
            echo view('templates/footer', );
            return redirect()->route('settings')->withInput()->with('errors', $this->validator->getErrors());
        }

        $img = $this->request->getFile('userfile');

        if (! $img->hasMoved()) {

            $img = \Config\Services::image('gd')->withFile($img);
            
            $img->fit(150, 150);
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

            echo view('templates/header', );
            echo view('settings', );
            echo view('templates/footer', );
            return redirect()->route('settings')->with('message', "Upload Successful.");
        }

        echo view('templates/header', );
        echo view('settings', );
        echo view('templates/footer', );
        return redirect()->route('settings')->with('error', "The file has already been moved.");
    }
}
