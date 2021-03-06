<?php
class Tag
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getTags()
    {
        $this->db->query("
        SELECT * FROM tbl_tags ORDER BY created_at DESC
        ");

        $result = $this->db->resultSet();

        return $result;
    }

    public function getTagByUserId($user_id)
    {
        $this->db->query("
        SELECT * FROM tbl_tags WHERE user_id=:user_id
        ORDER BY created_at DESC
        ");

        $this->db->bind(':user_id', $user_id);

        $result = $this->db->resultSet();

        return $result;
    }

    public function getTagById($tag_id)
    {
        $this->db->query("SELECT * FROM tbl_tags WHERE tag_id = :tag_id");
        $this->db->bind(':tag_id', $tag_id);

        $row = $this->db->singleRow();

        return $row;
    }

    public function addTag($data)
    {
        $this->db->query("INSERT INTO tbl_tags (user_id, tag_title, created_at) VALUES (:user_id, :tag_title, :created_at)");

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':tag_title', $data['tag_title']);
        $this->db->bind(':created_at', date('Y-m-d H:i:s'));

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateTag($data)
    {
        $this->db->query("UPDATE tbl_tags SET tag_title=:tag_title, edited_at=:edited_at WHERE tag_id=:tag_id");

        $this->db->bind(':tag_id', $data['tag_id']);
        $this->db->bind(':tag_title', $data['tag_title']);
        $this->db->bind(':edited_at', date('Y-m-d H:i:s'));

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePermanently($tag_id)
    {

        //update the tag_id from tbl_notes back to 0
        $this->db->query("UPDATE tbl_notes SET tag_id=0 WHERE tag_id=:tag_id");
        $this->db->bind(':tag_id', $tag_id);
        $this->db->execute();
        
        $this->db->query("DELETE FROM tbl_tags WHERE tag_id=:tag_id");
        $this->db->bind(':tag_id', $tag_id);

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
