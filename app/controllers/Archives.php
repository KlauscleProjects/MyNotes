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

        $this->archiveModel = $this->model('Archive');
        $this->userModel = $this->model('User');
    }

    public function index()
    {

        //get archive notes
        $archives = $this->archiveModel->getNotes();

        $data = [
            'page_title' => "Archive Notes",
            'notes' => $archives
        ];

        $this->loadView('archives/index', $data);
    }
}
