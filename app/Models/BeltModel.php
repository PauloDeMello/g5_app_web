<?php

namespace App\Models;

use CodeIgniter\Model;

class BeltModel extends Model
{
    protected $table      = 'syllabusdata';
    protected $primaryKey = 'id';
    protected $belt = 'belt';
    protected $syllabus = 'syllabus';

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function ReturnSyllabusArrayBeltPair(string $belt, string $syllabusString)
    {

        $syllabusArray = explode(" ,. ", $syllabusString);

        $formattedSyllabusArray = [];

        foreach ($syllabusArray as $value)
        {
            
            $valueArray = explode(" | ", $value);
            $formattedSyllabusArray[] = $valueArray;
        }

        return [$belt, $formattedSyllabusArray];
    }

    public function SetupBeltModel(string $currentBelt, array $belts)
    {
        $formattedSyllabusArray = [];

        foreach($belts as $belt)
        {
            $sql = 
            "SELECT id, belt, syllabus FROM $this->table WHERE belt='$belt'";
            $result = $this->query($sql);

            if(count($result->getResultArray()) > 0) 
            {
                $userResult = $result->getrow();
            }

            $syllabusString = $userResult->syllabus;

            $formattedSyllabusArray[] = $this->ReturnSyllabusArrayBeltPair($belt, $syllabusString);
        } 
        
        $this->syllabus = $formattedSyllabusArray;
        $this->belt = $currentBelt;
    }
}