<?php
class Note
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addNote($data)
    {
        $this->db->query("INSERT INTO tbl_notes (user_id, note_title, note_body, created_at) VALUES (:user_id, :note_title, :note_body, :created_at)");

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':note_title', $data['note_title']);
        $this->db->bind(':note_body', $data['note_body']);
        $this->db->bind(':created_at', date('Y-m-d H:i:s'));

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
