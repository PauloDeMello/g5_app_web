<?php

namespace App\Models;

use CodeIgniter\Model;

class AnnouncementModel extends Model
{
    protected $table      = 'announcements';
    protected $primaryKey = 'id';
    protected $title = 'title';
    protected $messageVar = 'message';
    protected $timestampVar = 'timestamp';

    protected $allowedFields = ['title', 'message'];

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function SetupLatestAnnouncementModel()
    {
        $sql =
        "SELECT * FROM $this->table ORDER BY id DESC LIMIT 1";

        $result = $this->query($sql);

        if(count($result->getResultArray()) > 0) 
        {
            $userResult = $result->getrow();
        }

        $this->primaryKey = $this->id;
        $this->title = $userResult->title;
        $this->messageVar = $userResult->message;
        $this->timestampVar = $userResult->timestamp;
    }

    public function PostAnnouncement(string $title, string $message)
    {
        $data = array('title'=>$title, 'message'=>$message);
        $isSuccessful = $this->insert($data, false);
        return $isSuccessful;
    }
}