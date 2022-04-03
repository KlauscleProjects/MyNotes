<?php
class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        if (isLoggedIn()) {
            redirect('notes');
        }

        $data = [
            'title' => 'My Notes',
            'description' => 'A simple note taking web page with login and registration'
        ];

        $this->loadView("pages/index", $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Page',
            'description' => 'A simple note taking web page with login and registration'
        ];
        $this->loadView("pages/about", $data);
    }
}
