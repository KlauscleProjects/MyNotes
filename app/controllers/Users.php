<?php
class Users extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        //check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //init data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'error_name' => '',
                'error_email' => '',
                'error_password' => '',
                'error_confirm_password' => ''
            ];

            //validations
            if (empty($data['email'])) {
                $data['error_email'] = "Please enter email";
            } else {
                //check email if exist
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['error_email'] = "Email already exist";
                }
            }

            if (empty($data['name'])) {
                $data['error_name'] = "Please enter name";
            }

            if (empty($data['password'])) {
                $data['error_password'] = "Please enter password";
            } elseif (strlen($data['password']) < 6) {
                $data['error_password'] = "Password must be atleast 6 characters";
            }

            if (empty($data['confirm_password'])) {
                $data['error_confirm_password'] = "Please confirm password";
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['error_confirm_password'] = "Password mismatch";
                }
            }

            //make sure error are empty
            if (empty($data['error_email']) && empty($data['error_name']) && empty($data['error_password']) && empty($data['error_confirm_password'])) {
                //hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //register user
                if ($this->userModel->register($data)) {
                    flash('register_success', 'You are registered and can log in now');
                    redirect('users/login');
                } else {
                    die("Something went wrong");
                }
            } else {
                //load the view with errors
                $this->loadView('users/register', $data);
            }
        } else {
            //init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'error_name' => '',
                'error_email' => '',
                'error_password' => '',
                'error_confirm_password' => ''
            ];

            //load view
            $this->loadView('users/register', $data);
        }
    }

    public function login()
    {
        //check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'error_email' => '',
                'error_password' => ''
            ];

            //validations
            if (empty($data['email'])) {
                $data['error_email'] = "Please enter email";
            }
            if (empty($data['password'])) {
                $data['error_password'] = "Please enter password";
            }

            //check for user and email
            if ($this->userModel->findUserByEmail($data['email'])) {
            } else {
                $data['error_email'] = "Email not found";
            }

            //make sure error are empty
            if (empty($data['error_email']) && empty($data['error_password'])) {
                //check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']); //contains array of objects OR false
                if ($loggedInUser) {
                    //create session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['error_password'] = 'Password incorrect';
                    $this->loadView('users/login', $data);
                }
            } else {
                //load the view with errors
                $this->loadView('users/login', $data);
            }
        } else {
            //init data
            $data = [
                'email' => '',
                'password' => '',
                'error_email' => '',
                'error_password' => ''
            ];

            //load view
            $this->loadView('users/login', $data);
        }
    }

    public function createUserSession($loggedInUser)
    {
        $_SESSION['user_id'] = $loggedInUser->id;
        $_SESSION['user_email'] = $loggedInUser->email;
        $_SESSION['user_name'] = $loggedInUser->name;
        redirect('posts/index');
    }

    //logout 
    public function logout()
    {
        session_unset();
        session_destroy();
        redirect('users/login');
    }

}
