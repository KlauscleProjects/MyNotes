<?php
class Archives extends Controller
{
    private $archiveModel;
    private $userModel;
    private $tagModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->archiveModel = $this->model('Archive');
        $this->userModel = $this->model('User');
        $this->tagModel = $this->model('Tag');
    }

    public function index()
    {

        //get archive notes
        $archives = $this->archiveModel->getNotes($_SESSION['user_id']);

        //get tags
        $tags = $this->tagModel->getTags();

        $data = [
            'page_title' => "Archive Notes",
            'notes' => $archives,
            'tags' => $tags
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

    public function edit($note_id)
    {
        //get tags
        $tags = $this->tagModel->getTags();

        //get all tags by user
        $tagsByUser = $this->tagModel->getTagByUserId($_SESSION['user_id']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'page_title' => "Edit Archive Note",
                'note_id' => $note_id,
                'note_title' => trim($_POST['note_title']),
                'note_body' => trim($_POST['note_body']),
                'tag_id' => trim($_POST['tag_id']),
                'user_id' => $_SESSION['user_id'],
                'tags' => $tags
            ];

            if ($this->archiveModel->updateNote($data)) {
                flash('the_message', 'Note successfully updated');
                redirect('archives');
            } else {
                die("Something went wrong");
            }
        } else {
            // get existing note from model
            $note = $this->archiveModel->getNoteById($note_id);

            //check for owner
            if ($note->user_id != $_SESSION['user_id']) {
                redirect('archives');
            }

            $data = [
                'page_title' => "Edit Archive Note",
                'note_id' => $note_id,
                'note_title' => $note->note_title,
                'note_body' => $note->note_body,
                'created_at' => $note->created_at,
                'edited_at' => $note->edited_at,
                'tag_id' => $note->tag_id,
                'tags' => $tags,
                'user_id' => $_SESSION['user_id'],
                'tagsByUser' =>  $tagsByUser
            ];
            $this->loadView('archives/edit', $data);
        }
    }

    public function delete($note_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // get existing note from model
            $note = $this->archiveModel->getNoteById($note_id);

            //check for owner
            if ($note->user_id != $_SESSION['user_id']) {
                redirect('notes');
            }

            if ($this->archiveModel->toTrashNote($note_id)) {
                //redirect('notes');
                //reload the page base on the sweet alert of javascript
            } else {
                die("Something went wrong");
            }
        }
    }
}
