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
                'page_title' => "REGISTRATION",
                'fname' => trim($_POST['fname']),
                'lname' => trim($_POST['lname']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'error_fname' => '',
                'error_lname' => '',
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

            if (empty($data['fname'])) {
                $data['error_fname'] = "Please enter your first name";
            }
            if (empty($data['lname'])) {
                $data['error_lname'] = "Please enter your last name";
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
            if (empty($data['error_email']) && empty($data['error_fname']) && empty($data['error_lname']) && empty($data['error_password']) && empty($data['error_confirm_password'])) {
                //hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //register user
                if ($this->userModel->register($data)) {
                    flash('the_message', 'You are registered and can log in now');
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
                'page_title' => "REGISTRATION",
                'fname' => '',
                'lname' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'error_fname' => '',
                'error_lname' => '',
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
                'page_title' => "LOGIN",
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
                'page_title' => "LOGIN",
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
        $_SESSION['user_id'] = $loggedInUser->user_id;
        $_SESSION['user_email'] = $loggedInUser->user_email;
        $_SESSION['user_fname'] = $loggedInUser->user_fname;
        $_SESSION['user_lname'] = $loggedInUser->user_lname;
        redirect('notes/index');
    }

    public function account($user_id)
    {
        //check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //init data
            $data = [
                'page_title' => "User Account",
                'fname' => trim($_POST['fname']),
                'lname' => trim($_POST['lname']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'user_id' => $user_id,

                'error_fname' => '',
                'error_lname' => '',
                'error_email' => '',
                'error_password' => '',
                'error_confirm_password' => ''
            ];

            //validations
            if (empty($data['email'])) {
                $data['error_email'] = "Please enter email";
            } else {
                //check email if exist
                if ($this->userModel->findUserByEmailToUpdate($user_id, $data['email'])) {
                    $data['error_email'] = "Email already exist";
                }
            }

            if (empty($data['fname'])) {
                $data['error_fname'] = "Please enter your first name";
            }
            if (empty($data['lname'])) {
                $data['error_lname'] = "Please enter your last name";
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
            if (empty($data['error_email']) && empty($data['error_fname']) && empty($data['error_lname']) && empty($data['error_password']) && empty($data['error_confirm_password'])) {
                //hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                $updatedUserInfo = $this->userModel->updateUser($data);

                //update user account
                if ($updatedUserInfo) {
                    //create session
                    $this->createUserSession($updatedUserInfo);
                    flash('the_message', 'Your information has been updated successfully');
                    redirect('users/account/' . $user_id);
                } else {
                    die("Something went wrong");
                }
            } else {
                //load the view with errors
                $this->loadView('users/account', $data);
            }
        } else {
            $user = $this->userModel->getUserById($user_id);

            //check for owner
            if ($user_id != $_SESSION['user_id']) {
                redirect('notes');
            }

            $data = [
                'page_title' => "User Account",
                'fname' => "$user->user_fname",
                'lname' => $user->user_lname,
                'email' => $user->user_email,
                'user_id' => $user_id,
                'password' => '',
                'confirm_password' => '',
                'error_fname' => '',
                'error_lname' => '',
                'error_email' => '',
                'error_password' => '',
                'error_confirm_password' => ''
            ];

            //load view
            $this->loadView('users/account', $data);
        }
    }

    //logout 
    public function logout()
    {
        session_unset();
        session_destroy();
        redirect('users/login');
    }
}
