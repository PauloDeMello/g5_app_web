<?php

namespace App\Controllers;

use App\Models\BeltModel;

class Syllabus extends BaseController
{
    public function index(): string
    {
        $beltModel = new BeltModel();
        $beltID = auth()->user()->belt;
        $syllabus = $beltModel->ReturnSyllabusArray($beltID);
        $beltModel->SetupBeltModel($beltID);
        $name = auth()->user()->name;
        $class = auth()->user()->class;
        $data = ['name' => $name, 'syllabus' => $beltModel->syllabus, 'beltName' => $beltModel->name, 'class' => $class];
        return view('home', $data);
    }
}
