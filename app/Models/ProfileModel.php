<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    protected $table      = 'profiledata';
    protected $primary_id = 'id';
    protected $user_id = 'user_id';
    protected $belt_grades = 'belt_grades';

    
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

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function ReturnBeltGradesArray($beltGradesString)
    {

        $beltGradesArray = explode(" ,. ", $beltGradesString);

        $formattedBeltGradesArray = [];

        $kyuBeltPair = 
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

        $kyu_array = [];

        for ($i=0; $i < count($beltGradesArray); $i++){
            $valueArray = explode(" | ", $beltGradesArray[$i]);
            $belt_name = $valueArray[0];
            $valueArray[] = $belt_name;
            $valueArray[0] = $kyuBeltPair[$belt_name];
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