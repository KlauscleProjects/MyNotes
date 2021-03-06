<?php
class Tags extends Controller
{
    private $tagModel;
    private $userModel;
    private $noteModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->tagModel = $this->model('Tag');
        $this->userModel = $this->model('User');
        $this->noteModel = $this->model('Note');
    }

    public function index()
    {

        //get tags
        $tags = $this->tagModel->getTags();

        $data = [
            'page_title' => "My Tags",
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
                flash('the_message', 'Tag successfully created');
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

    public function edit($tag_id)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'page_title' => "Edit Tag",
                'tag_id' => $tag_id,
                'tag_title' => trim($_POST['tag_title']),
                'user_id' => $_SESSION['user_id'],
            ];

            if ($this->tagModel->updateTag($data)) {
                flash('the_message', 'Note successfully updated');
                redirect('tags');
            } else {
                die("Something went wrong");
            }
        } else {
            //get specific tag
            $tag = $this->tagModel->getTagById($tag_id);

            //get all tags
            $tags = $this->tagModel->getTags();

            //check for owner
            if ($tag->user_id != $_SESSION['user_id']) {
                redirect('tags');
            }

            $data = [
                'page_title' => "Edit Tag",
                'tags' => $tags,
                'tag_id' => $tag_id,
                'tag_title' => $tag->tag_title,
                'user_id' => $_SESSION['user_id'],
            ];
            $this->loadView('tags/edit', $data);
        }
    }

    public function delete($tag_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // get existing tag from model
            $tag = $this->tagModel->getTagById($tag_id);

            //check for owner
            if ($tag->user_id != $_SESSION['user_id']) {
                redirect('tags');
            }

            if ($this->tagModel->deletePermanently($tag_id)) {
                //redirect('notes');
                //reload the page base on the sweet alert of javascript
            } else {
                die("Something went wrong");
            }
        }
    }

    public function show($tag_id)
    {
        //get notes
        $notes = $this->noteModel->getNoteByTagId($tag_id);

        //get specific tag
        $tag = $this->tagModel->getTagById($tag_id);

        $data = [
            'page_title' => "Show Tag: ",
            'notes' => $notes,
            'tag_title' => $tag->tag_title,
            'tag_id' => $tag_id
        ];

        $this->loadView('tags/show', $data);
    }

    public function bulkDelete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $selectedIDs = $_POST['tokens'];

            foreach ($selectedIDs as $tag_id) {
                $this->delete($tag_id);
            }
        }
    }
}
