<?php
class Archives extends Controller
{
    private $archiveModel;
    private $userModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->archiveModel = $this->model('Archive');
        $this->userModel = $this->model('User');
    }

    public function index()
    {

        //get archive notes
        $archives = $this->archiveModel->getNotes();

        $data = [
            'page_title' => "Archive Notes",
            'notes' => $archives
        ];

        $this->loadView('archives/index', $data);
    }

    public function restore($note_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // get existing note from model
            $note = $this->archiveModel->getNoteById($note_id);

            //check for owner
            if ($note->user_id != $_SESSION['user_id']) {
                redirect('trash');
            }

            if ($this->archiveModel->restoreNote($note_id)) {
                //redirect('notes');
                //reload the page base on the sweet alert of javascript
            } else {
                die("Something went wrong");
            }
        }
    }
}
