<?php
class Archive
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    //ARCHIVE NOTES
    public function getNotes()
    {
        $this->db->query("
        SELECT *, tbl_notes.note_id as noteID, tbl_users.user_id as userID, tbl_notes.created_at as noteCreatedAt, tbl_users.created_at as userCreatedAt
        FROM tbl_notes
        INNER JOIN tbl_users
        ON tbl_notes.user_id = tbl_users.user_id
        AND note_archive = 1
        ORDER BY tbl_notes.created_at DESC
        ");

        $result = $this->db->resultSet();

        return $result;
    }

    public function getNoteById($note_id)
    {
        $this->db->query("SELECT * FROM tbl_notes WHERE note_id = :note_id");
        $this->db->bind(':note_id', $note_id);

        $row = $this->db->singleRow();

        return $row;
    }

    public function restoreNote($note_id)
    {
        $this->db->query("UPDATE tbl_notes SET note_archive=0 WHERE note_id=:note_id");
        $this->db->bind(':note_id', $note_id);

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
