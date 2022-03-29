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

        //get posts
        // $posts = $this->postModel->getPosts();

        $data = [
            'page_title' => "My Notes",
            //'posts' => $posts
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
}
