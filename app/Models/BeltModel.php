<?php

namespace App\Models;

use CodeIgniter\Model;

class BeltModel extends Model
{
    protected $table      = 'syllabusdata';
    protected $primaryKey = 'id';
    protected $beltID = 'beltID';
    protected $name = 'name';
    protected $syllabus = 'syllabus';

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function ReturnSyllabusArray(string $syllabusString)
    {

        $syllabusArray = explode(" ,. ", $syllabusString);

        $formattedSyllabusArray = [];

        foreach ($syllabusArray as $value)
        {
            
            $valueArray = explode(" | ", $value);
            $formattedSyllabusArray[] = $valueArray;
        }

        return $formattedSyllabusArray;
    }

    public function SetupBeltModel(int $beltId)
    {
        $sql = 
        "SELECT id, beltID, name, syllabus FROM $this->table WHERE beltID=$beltId";
        $result = $this->query($sql);

        if(count($result->getResultArray()) > 0) 
        {
            $userResult = $result->getrow();
        }

        $syllabusString = $userResult->syllabus;
        $this->syllabus = $this->ReturnSyllabusArray($syllabusString);
        $this->name = $userResult->name;
    }
}