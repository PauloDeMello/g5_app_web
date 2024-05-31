<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    protected $table      = 'profiledata';
    protected $primary_id = 'id';
    protected $user_id = 'user_id';
    protected $belt_grades = 'belt_grades';

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function ReturnBeltGradesArray($beltGradesString)
    {

        $beltGradesArray = explode(" ,. ", $beltGradesString);

        $formattedBeltGradesArray = [];

        foreach ($beltGradesArray as $value)
        {
            
            $valueArray = explode(" | ", $value);
            $formattedBeltGradesArray[] = $valueArray;
        }

        return $formattedBeltGradesArray;
    }

    public function SetupProfileModel(int $user_id)
    {
        $sql = 
        "SELECT id, user_id, belt_grades FROM $this->table WHERE user_id='$user_id'";
        $result = $this->query($sql);

        if(count($result->getResultArray()) > 0) 
        {
            $userResult = $result->getrow();
        }

        $beltGradesString = $userResult->belt_grades;

        $formattedBeltGradesArray[] = $this->ReturnBeltGradesArray($beltGradesString);
        
        $this->belt_grades = $formattedBeltGradesArray;
    }
}