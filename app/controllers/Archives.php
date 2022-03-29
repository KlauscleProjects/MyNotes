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

        $this->postModel = $this->model('Archive');
        $this->userModel = $this->model('User');
    }

    public function index()
    {

        //get posts
        // $posts = $this->postModel->getPosts();

        $data = [
            'title' => "Archive Notes",
            //'posts' => $posts
        ];

        $this->loadView('archives/index', $data);
    }

}
