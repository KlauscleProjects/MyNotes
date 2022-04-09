<?php
class Notes extends Controller
{
    private $noteModel;
    private $userModel;
    private $tagModel;

    private $archiveModel;
    private $trashModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->noteModel = $this->model('Note');
        $this->userModel = $this->model('User');
        $this->tagModel = $this->model('Tag');
        $this->archiveModel = $this->model('Archive'); //use for the bulk selection
        $this->trashModel = $this->model('Trash'); //use for the bulk selection
    }

    public function index()
    {

        //get notes
        $notes = $this->noteModel->getNotes($_SESSION['user_id']);

        //get tags
        $tags = $this->tagModel->getTags();

        $data = [
            'page_title' => "My Notes",
            'notes' => $notes,
            'tags' => $tags
        ];

        $this->loadView('notes/index', $data);
    }

    public function add()
    {
        //get all tags
        $tags = $this->tagModel->getTags();

        //get all tags by user
        $tagsByUser = $this->tagModel->getTagByUserId($_SESSION['user_id']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'page_title' => "Add Note",
                'note_title' => trim($_POST['note_title']),
                'note_body' => trim($_POST['note_body']),
                'tag_id' => trim($_POST['tag_id']),
                'user_id' => $_SESSION['user_id'],
                'tags' => $tags
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
                'tags' => $tags,
                'tagsByUser' =>  $tagsByUser
            ];

            $this->loadView('notes/add', $data);
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
                'page_title' => "Edit Note",
                'note_id' => $note_id,
                'note_title' => trim($_POST['note_title']),
                'note_body' => trim($_POST['note_body']),
                'tag_id' => trim($_POST['tag_id']),
                'user_id' => $_SESSION['user_id'],
                'tags' => $tags
            ];

            if ($this->noteModel->updateNote($data)) {
                flash('the_message', 'Note successfully updated');
                redirect('notes');
            } else {
                die("Something went wrong");
            }
        } else {
            // get existing note from model
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
                'created_at' => $note->created_at,
                'edited_at' => $note->edited_at,
                'tag_id' => $note->tag_id,
                'tags' => $tags,
                'user_id' => $_SESSION['user_id'],
                'tagsByUser' =>  $tagsByUser
            ];
            $this->loadView('notes/edit', $data);
        }
    }

    public function archive($note_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // get existing note from model
            $note = $this->noteModel->getNoteById($note_id);

            //check for owner
            if ($note->user_id != $_SESSION['user_id']) {
                redirect('notes');
            }

            if ($this->noteModel->archiveNote($note_id)) {
                //redirect('notes');
                //reload the page base on the sweet alert of javascript
            } else {
                die("Something went wrong");
            }
        }
    }

    public function delete($note_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // get existing note from model
            $note = $this->noteModel->getNoteById($note_id);

            //check for owner
            if ($note->user_id != $_SESSION['user_id']) {
                redirect('notes');
            }

            if ($this->noteModel->toTrashNote($note_id)) {
                //redirect('notes');
                //reload the page base on the sweet alert of javascript
            } else {
                die("Something went wrong");
            }
        }
    }

    public function bulkAction($action)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $selectedIDs = $_POST['tokens'];

            foreach ($selectedIDs as $note_id) {
                // get existing note from model
                $note = $this->noteModel->getNoteById($note_id);

                //check for owner
                if ($note->user_id != $_SESSION['user_id']) {
                    redirect('notes');
                }

                switch ($action) {
                    case '1':
                        $this->noteModel->archiveNote($note_id);
                        break;
                    case '2':
                        $this->noteModel->toTrashNote($note_id);
                        break;
                    case '3':
                        $this->archiveModel->restoreNote($note_id);
                        break;
                    case '4':
                        $this->trashModel->restoreNote($note_id);
                        break;
                    case '5':
                        $this->trashModel->deletePermanently($note_id);
                        break;
                    default:
                        break;
                }
            }
        }
    }
}
