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

        $this->postModel = $this->model('Tag');
        $this->userModel = $this->model('User');
    }

    public function index()
    {

        //get posts
        // $posts = $this->postModel->getPosts();

        $data = [
            'title' => "Tags",
            //'posts' => $posts
        ];

        $this->loadView('tags/index', $data);
    }
}
