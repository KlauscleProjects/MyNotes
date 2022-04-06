<?php
class Forgotpassword
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function deleteEmail($email)
    {
        $this->db->query('DELETE FROM tbl_pswrdreset WHERE reset_email=:reset_email');
        $this->db->bind(':reset_email', $email);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function insertToken($data)
    {
        $this->db->query(
            'INSERT INTO tbl_pswrdreset (reset_email, reset_selector, reset_token, reset_expires) 
            VALUES (:reset_email, :reset_selector, :reset_token, :reset_expires)'
        );

        $this->db->bind(':reset_email', $data['email']);
        $this->db->bind(':reset_selector', $data['selector']);
        $this->db->bind(':reset_token', $data['hashedToken']);
        $this->db->bind(':reset_expires', $data['expires']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //function if the link is expires
    public function resetPassword($data)
    {
        $this->db->query(
            'SELECT * FROM tbl_pswrdreset WHERE reset_selector=:reset_selector AND reset_expires >= :currentDate'
        );

        $this->db->bind(':reset_selector', $data['selector']);
        $this->db->bind(':currentDate', $data['currentDate']);

        $row = $this->db->singleRow();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
    

}
