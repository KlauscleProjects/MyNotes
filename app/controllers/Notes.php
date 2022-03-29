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

        $this->postModel = $this->model('Note');
        $this->userModel = $this->model('User');
    }

    public function index()
    {

        //get posts
        // $posts = $this->postModel->getPosts();

        $data = [
            'title' => "My Notes",
            //'posts' => $posts
        ];

        $this->loadView('notes/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => "Add Note",
            //'posts' => $posts
        ];

        $this->loadView('notes/add', $data);
    }

    public function archives()
    {
        $data = [
            'title' => "Archive Notes",
            //'posts' => $posts
        ];

        $this->loadView('notes/archives', $data);
    }

    public function tags()
    {
        $data = [
            'title' => "Tags",
            //'posts' => $posts
        ];

        $this->loadView('notes/tags', $data);
    }
}
