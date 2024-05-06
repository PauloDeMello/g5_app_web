<?php

namespace App\Controllers;

use App\Models\BeltModel;

class Home extends BaseController
{
    public function index(): string
    {
        $beltModel = new BeltModel();
        $beltID = auth()->user()->belt;
        $syllabus = $beltModel->ReturnSyllabusArray($beltID);
        $beltModel->SetupBeltModel($beltID);
        $data = ['syllabus' => $beltModel->syllabus, 'beltName' => $beltModel->name];
        return view('home', $data);
    }
}
