<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


class Forgotpasswords extends Controller
{
    private $userModel;
    private $forgotpasswordModel;
    private $mail;

    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->forgotpasswordModel = $this->model('forgotpassword');

        //Create an instance; passing `true` enables exceptions
        $this->mail = new PHPMailer(true);

        //Server settings
        $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $this->mail->isSMTP();                                            //Send using SMTP
        $this->mail->Host       = MAILER_HOST;                     //Set the SMTP server to send through
        $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $this->mail->Username   = MAILER_EMAIL;                     //SMTP username
        $this->mail->Password   = MAILER_PASSWORD;                               //SMTP password
        $this->mail->SMTPSecure = MAILER_SMTPSECURE;            //Enable implicit TLS encryption
        $this->mail->Port       = MAILER_PORT;
    }

    public function index()
    {
        //check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //init data
            $data = [
                'page_title' => "RESET PASSWORD",
                'email' => trim($_POST['email']),
                'error_email' => '',
            ];

            //validations
            if (empty($data['email'])) {
                $data['error_email'] = "Please enter email";
            }

            //check for user and email
            if ($this->userModel->findUserByEmail($data['email'])) {
                $this->sendEmail($data['email']);
            } else {
                $data['error_email'] = "Email not found";
            }

            //make sure error are empty
            if (empty($data['error_email'])) {
                $this->sendEmail($data['email']);
                flash('the_message', 'Your reset link has been sent to your email.');
                redirect('forgotpasswords/index');
            } else {
                //load the view with errors
                $this->loadView('forgotpasswords/index', $data);
            }
        } else {
            //init data
            $data = [
                'page_title' => "RESET PASSWORD",
                'email' => '',
                'error_email' => '',
            ];

            //load view
            $this->loadView('forgotpasswords/index', $data);
        }
    }

    public function resetpassword($selector = "", $validator = "")
    {
        //check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //init data
            $data = [
                'page_title' => "CREATE NEW PASSWORD",
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'selector' => $selector,
                'validator' => $validator,
                'error_password' => '',
                'error_confirm_password' => '',
                'currentDate' => date("U") //gets the current date for expiration checking
            ];

            $url = 'forgotpasswords/resetpassword/' . $data['selector'] . '/' . $data['validator'];

            //validations
            if (empty($data['password'])) {
                $data['error_password'] = "Please enter password";
            } elseif (strlen($data['password']) < 6) {
                $data['error_password'] = "Password must be atleast 6 characters ";
            }

            if (empty($data['confirm_password'])) {
                $data['error_confirm_password'] = "Please confirm password";
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['error_confirm_password'] = "Password mismatch";
                }
            }

            //make sure error are empty
            if (empty($data['error_password']) && empty($data['error_confirm_password'])) {

                $row = $this->forgotpasswordModel->resetpassword($data);
                if (!$row) {
                    flash('the_message', 'Sorry, the link is no longer valid', 'alert alert-danger');
                    redirect($url);
                }

                $tokenBin = hex2bin($data['validator']);
                $tokenCheck = password_verify($tokenBin, $row->reset_token);
                if (!$tokenCheck) {
                    flash('the_message', 'You need to re-submit your reset request', 'alert alert-danger');
                    redirect($url);
                }

                $tokenEmail = $row->reset_email;
                //check for user and email
                if (!$this->userModel->findUserByEmail($tokenEmail)) {
                    die('There was an error');
                }

                //update the password in user model
                $newPasswordHash = password_hash($data['password'], PASSWORD_DEFAULT);
                if (!$this->userModel->resetpassword($tokenEmail, $newPasswordHash)) {
                    die('There was an error');
                }

                //delete the row in tbl_pswrdreset	
                if (!$this->forgotpasswordModel->deleteEmail($row->reset_email)) {
                    die('There was an error');
                }

                flash('the_message', 'Password successfully updated');
                redirect('users/login');
            } else {
                //load the view with errors
                $this->loadView('forgotpasswords/resetpassword', $data);
            }
        } else {
            //init data
            $data = [
                'page_title' => "CREATE NEW PASSWORD",
                'password' => '',
                'confirm_password' => '',
                'error_password' => '',
                'error_confirm_password' => '',
                'selector' => $selector,
                'validator' => $validator,
            ];

            if (empty($selector) || empty($validator)) {
                die('Could not validate your request');
            }

            //check if the params are in hexadecimal value
            if (!(ctype_xdigit($selector) && ctype_xdigit($validator))) {
                die('Could not validate your request');
            }

            //load view
            $this->loadView('forgotpasswords/resetpassword', $data);
        }
    }

    private function sendEmail($userEmail)
    {
        //Will be used to query the user from the database
        $selector = bin2hex(random_bytes(8));
        //Will be used for confirmation once the database entry has been matched
        $token = random_bytes(32);
        //URL will vary depending on where the website is being hosted from
        $url = URLROOT . '/forgotpasswords/resetpassword/' . $selector . '/' . bin2hex($token);
        //Expiration date will last for half an hour
        $expires = date("U") + 1800;

        if (!$this->forgotpasswordModel->deleteEmail($userEmail)) {
            die('There was an error');
        }

        $hashedToken = password_hash($token, PASSWORD_DEFAULT);

        $data  = [
            'email' => $userEmail,
            'selector' => $selector,
            'hashedToken' => $hashedToken,
            'expires' => $expires
        ];

        if (!$this->forgotpasswordModel->insertToken($data)) {
            die("There was an error");
        }

        //Can Send Email Now
        $subject = "Reset your password";
        $message = "<p>We recieved a password reset request.</p>";
        $message .= "<p>Here is your password reset link: </p>";
        $message .= "<a href='" . $url . "'>" . $url . "</a>";

        //Recipients
        $this->mail->setFrom(MAILER_EMAIL);
        $this->mail->isHTML(true);
        $this->mail->Subject = $subject;
        $this->mail->Body = $message;
        $this->mail->addAddress($userEmail);

        if (!$this->mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $this->mail->ErrorInfo;
        }

        redirect('forgotpasswords');
    }
}
