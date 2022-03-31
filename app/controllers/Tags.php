<?php
class Tags extends Controller
{
    private $tagModel;
    private $userModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->tagModel = $this->model('Tag');
        $this->userModel = $this->model('User');
    }

    public function index()
    {

        //get tags
        $tags = $this->tagModel->getTags();

        $data = [
            'page_title' => "Tags",
            'tags' => $tags
        ];

        $this->loadView('tags/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'page_title' => "Add Tag",
                'tag_title' => trim($_POST['tag_title']),
                'user_id' => $_SESSION['user_id'],
            ];

            if ($this->tagModel->addTag($data)) {
                flash('the_message', 'Note successfully created');
                redirect('tags');
            } else {
                die("Something went wrong");
            }
        } else {
            $data = [
                'page_title' => "Add Tag",
                'user_id' => $_SESSION['user_id'],
            ];
            $this->loadView('notes/add', $data);
        }
    }
}
