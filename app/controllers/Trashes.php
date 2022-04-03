<?php
class Trashes extends Controller
{
    private $trashModel;
    private $userModel;
    private $tagModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->trashModel = $this->model('Trash');
        $this->userModel = $this->model('User');
        $this->tagModel = $this->model('Tag');
    }

    public function index()
    {

        //get trash notes
        $trashes = $this->trashModel->getTrash();

        //get tags
        $tags = $this->tagModel->getTags();

        $data = [
            'page_title' => "Trash",
            'notes' => $trashes,
            'tags' => $tags
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
        // get existing note from model
        $note = $this->trashModel->getNoteById($note_id);

        //get tags
        $tags = $this->tagModel->getTags();

        //check for owner
        if ($note->user_id != $_SESSION['user_id']) {
            redirect('notes');
        }

        $data = [
            'page_title' => "Show Note",
            'note_id' => $note_id,
            'tag_id' => $note->tag_id,
            'note_title' => $note->note_title,
            'note_body' => $note->note_body,
            'created_at' => $note->created_at,
            'edited_at' => $note->edited_at,
            'user_id' => $_SESSION['user_id'],
            'tags' => $tags
        ];
        $this->loadView('trash/show', $data);
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
