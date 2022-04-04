<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    //find user by email login
    public function findUserByEmail($email)
    {
        $this->db->query("SELECT * FROM tbl_users WHERE user_email= :email");
        $this->db->bind(':email', $email);

        $row = $this->db->singleRow();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //find if the new email is used by other users
    public function findUserByEmailToUpdate($user_id, $email)
    {
        $this->db->query("SELECT * FROM tbl_users WHERE user_id<>:user_id AND user_email= :email");
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':email', $email);

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //find user by id
    public function getUserById($user_id)
    {
        $this->db->query("SELECT * FROM tbl_users WHERE user_id= :user_id");
        $this->db->bind(':user_id', $user_id);

        $row = $this->db->singleRow();

        return $row;
    }

    //register user
    public function register($data)
    {
        $this->db->query("INSERT INTO tbl_users (user_fname, user_lname, user_email, user_password, created_at) VALUES (:fname, :lname, :email, :password, :created_at)");
        $this->db->bind(':fname', $data['fname']);
        $this->db->bind(':lname', $data['lname']);
        $this->db->bind(':email',  $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':created_at', date('Y-m-d H:i:s'));

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //login user
    public function login($email, $password)
    {
        $this->db->query("SELECT * FROM tbl_users WHERE user_email=:email");
        $this->db->bind(':email', $email);

        $row = $this->db->singleRow();

        $hashed_password = $row->user_password; //password column
        if (password_verify($password, $hashed_password)) {
            return $row; // the whole user row
        } else {
            return false;
        }
    }


    public function updateUser($data)
    {
        $this->db->query("UPDATE tbl_users SET user_fname=:user_fname, user_lname=:user_lname, user_email=:user_email, user_password=:user_password,edited_at=:edited_at WHERE user_id=:user_id");

        $this->db->bind(':user_fname', $data['fname']);
        $this->db->bind(':user_lname', $data['lname']);
        $this->db->bind(':user_email',  $data['email']);
        $this->db->bind(':user_password', $data['password']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':edited_at', date('Y-m-d H:i:s'));

        //execute
        if ($this->db->execute()) {
            $row = $this->getUserById($data['user_id']);
            return $row;
        } else {
            return false;
        }
    }
}
