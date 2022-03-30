<?php
class Notes extends Controller
{
    private $noteModel;
    private $userModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->noteModel = $this->model('Note');
        $this->userModel = $this->model('User');
    }

    public function index()
    {

        //get notes
        $notes = $this->noteModel->getNotes();

        $data = [
            'page_title' => "My Notes",
            'notes' => $notes
        ];

        $this->loadView('notes/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'page_title' => "Add Note",
                'note_title' => trim($_POST['note_title']),
                'note_body' => trim($_POST['note_body']),
                'user_id' => $_SESSION['user_id'],
            ];

            if ($this->noteModel->addNote($data)) {
                flash('the_message', 'Note successfully created');
                redirect('notes');
            } else {
                die("Something went wrong");
            }
        } else {
            $data = [
                'page_title' => "Add Note",
                'user_id' => $_SESSION['user_id'],
            ];

            $this->loadView('notes/add', $data);
        }
    }

    public function edit($note_id)
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

            if ($this->noteModel->updateNote($data)) {
                flash('the_message', 'Note successfully updated');
                redirect('notes');
            } else {
                die("Something went wrong");
            }
        } else {
            // get existing post from model
            $note = $this->noteModel->getNoteById($note_id);

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
            $this->loadView('notes/edit', $data);
        }
    }

    public function archive($note_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'note_id' => $note_id,
                'user_id' => $_SESSION['user_id'],
            ];

            if ($this->noteModel->archiveNote($data)) {
                //redirect('notes');
                //reload the page base on the sweet alert of javascript
            } else {
                die("Something went wrong");
            }
        }
    }
}
