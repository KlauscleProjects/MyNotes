<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    //find user by email
    public function findUserByEmail($email)
    {
        $this->db->query("SELECT * FROM users WHERE email= :email");
        $this->db->bind(':email', $email);

        $row = $this->db->singleRow();

        if ($this->db->rowCount() > 0) {
            return true; 
        } else {
            return false;
        }
    }

    //find user by id
    public function getUserById($user_id)
    {
        $this->db->query("SELECT * FROM users WHERE id= :user_id");
        $this->db->bind(':user_id', $user_id);

        $row = $this->db->singleRow();

        return $row;
    }

    //register user
    public function register($data)
    {
        $this->db->query("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email',  $data['email']);
        $this->db->bind(':password', $data['password']);

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //login user
    public function login($email, $password){
        $this->db->query("SELECT * FROM users WHERE email=:email");
        $this->db->bind(':email', $email);

        $row = $this->db->singleRow();

        $hashed_password = $row->password; //password column
        if(password_verify($password, $hashed_password)){
            return $row; // the whole user row
        }else{
            return false;
        }
    }

}
