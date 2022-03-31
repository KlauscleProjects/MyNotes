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
        $trashes = $this->trashModel->getTrash();

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

    public function show($note_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'page_title' => "Edit Note",
                'note_id' => $note_id,
                'note_title' => trim($_POST['note_title']),
                'note_body' => trim($_POST['note_body']),
                'user_id' => $_SESSION['user_id'],
            ];

            if ($this->trashModel->updateNote($data)) {
                flash('the_message', 'Note successfully updated');
                redirect('notes');
            } else {
                die("Something went wrong");
            }
        } else {
            // get existing note from model
            $note = $this->trashModel->getNoteById($note_id);

            //check for owner
            if ($note->user_id != $_SESSION['user_id']) {
                redirect('notes');
            }

            $data = [
                'page_title' => "Edit Note",
                'note_id' => $note_id,
                'note_title' => $note->note_title,
                'note_body' => $note->note_body,
                'user_id' => $_SESSION['user_id'],
            ];
            $this->loadView('trash/show', $data);
        }
    }

    public function delete($note_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // get existing note from model
            $note = $this->trashModel->getNoteById($note_id);

            //check for owner
            if ($note->user_id != $_SESSION['user_id']) {
                redirect('notes');
            }

            if ($this->trashModel->deletePermanently($note_id)) {
                //redirect('notes');
                //reload the page base on the sweet alert of javascript
            } else {
                die("Something went wrong");
            }
        }
    }
}
