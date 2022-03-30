<?php
class Note
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function getNotes()
    {
        $this->db->query("
        SELECT *, tbl_notes.note_id as noteID, tbl_users.user_id as userID, tbl_notes.created_at as noteCreatedAt, tbl_users.created_at as userCreatedAt
        FROM tbl_notes
        INNER JOIN tbl_users
        ON tbl_notes.user_id = tbl_users.user_id
        ORDER BY tbl_notes.created_at DESC
        ");

        $result = $this->db->resultSet();

        return $result;
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

    public function getNoteById($note_id)
    {
        $this->db->query("SELECT * FROM tbl_notes WHERE note_id = :note_id");
        $this->db->bind(':note_id', $note_id);

        $row = $this->db->singleRow();

        return $row;
    }

    public function updateNote($data)
    {
        $this->db->query("UPDATE tbl_notes SET note_title=:note_title, note_body=:note_body, edited_at=:edited_at WHERE note_id=:note_id");

        $this->db->bind(':note_id', $data['note_id']);
        $this->db->bind(':note_title', $data['note_title']);
        $this->db->bind(':note_body', $data['note_body']);
        $this->db->bind(':edited_at', date('Y-m-d H:i:s'));

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
