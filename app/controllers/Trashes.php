<?php
class Trashes extends Controller
{
    private $trashModel;
    private $userModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->trashModel = $this->model('Trash');
        $this->userModel = $this->model('User');
    }

    public function index()
    {

        //get trash notes
        $trashes= $this->trashModel->getTrash();

        $data = [
            'page_title' => "Trash",
            'notes' => $trashes
        ];

        $this->loadView('trash/index', $data);
    }

    public function restore($note_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // get existing note from model
            $note = $this->trashModel->getNoteById($note_id);

            //check for owner
            if ($note->user_id != $_SESSION['user_id']) {
                redirect('trash');
            }

            if ($this->trashModel->restoreNote($note_id)) {
                //redirect('notes');
                //reload the page base on the sweet alert of javascript
            } else {
                die("Something went wrong");
            }
        }
    }

}
