<?php
class Archive
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}
