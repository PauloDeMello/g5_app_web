<?php

namespace App\Models;

use CodeIgniter\Model;

class BeltModel extends Model
{
    protected $table      = 'beltdata';
    protected $primaryKey = 'id';
    protected $beltID = 'beltID';
    protected $name = 'name';
    protected $syllabus = 'syllabus';

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function ReturnSyllabusArray(int $beltId)
    {
        $sql = 
        "SELECT id, beltID, syllabus FROM beltdata WHERE beltID=$beltId";
        $result = $this->query($sql);

        if(count($result->getResultArray()) > 0) 
        {
            $userResult = $result->getrow();
        }

        $syllabusString = $userResult->syllabus;

        return explode(" ,. ", $syllabusString);
    }

    public function SetupBeltModel(int $beltId)
    {
        $sql = 
        "SELECT id, beltID, name, syllabus FROM beltdata WHERE beltID=$beltId";
        $result = $this->query($sql);

        if(count($result->getResultArray()) > 0) 
        {
            $userResult = $result->getrow();
        }

        $syllabusString = $userResult->syllabus;
        $this->syllabus = explode(" ,. ", $syllabusString);
        $this->name = $userResult->name;
    }
}