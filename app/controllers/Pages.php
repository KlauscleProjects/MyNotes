<?php
class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        if (isLoggedIn()) {
            redirect('posts');
        }

        $data = [
            'title' => 'MVC Shared Post',
            'description' => 'Simple social network built on the TraversyMVC PHP Framwork'
        ];

        $this->loadView("pages/index", $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Page',
            'description' => 'App to share posts with other users'
        ];
        $this->loadView("pages/about", $data);
    }
}
