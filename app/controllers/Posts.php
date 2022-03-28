<?php
class Posts extends Controller
{

    private $postModel;
    private $userModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    public function index()
    {

        //get posts
        $posts = $this->postModel->getPosts();

        $data = [
            'posts' => $posts
        ];
        $this->loadView('posts/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'error_title' => '',
                'error_body' => '',
            ];

            //validation for title 
            if (empty($data['title'])) {
                $data['error_title'] = "Please enter post title";
            }
            //validation for body
            if (empty($data['body'])) {
                $data['error_body'] = "Please enter post body";
            }

            //make sure no errors
            if (empty($data['error_title']) && empty($data['error_body'])) {
                //validated
                if ($this->postModel->addPost($data)) {
                    flash('post_message', 'Post successfully added');
                    redirect('posts');
                } else {
                    die("Something went wrong");
                }
            } else {
                //load the view with errors
                $this->loadView('posts/add', $data);
            }
        } else {
            $data = [
                'title' => '',
                'body' => '',
                'error_title' => '',
                'error_body' => '',
            ];
            $this->loadView('posts/add', $data);
        }
    }

    public function edit($post_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $post_id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'error_title' => '',
                'error_body' => '',
            ];

            //validation for title 
            if (empty($data['title'])) {
                $data['error_title'] = "Please enter post title";
            }
            //validation for body
            if (empty($data['body'])) {
                $data['error_body'] = "Please enter post body";
            }

            //make sure no errors
            if (empty($data['error_title']) && empty($data['error_body'])) {
                //validated
                if ($this->postModel->updatePost($data)) {
                    flash('post_message', 'Post successfully updated');
                    redirect('posts');
                } else {
                    die("Something went wrong");
                }
            } else {
                //load the view with errors
                $this->loadView('posts/edit', $data);
            }
        } else {
            // get existing post from model
            $post = $this->postModel->getPostById($post_id);

            //check for owner
            if ($post->user_id != $_SESSION['user_id']) {
                redirect('posts');
            }

            $data = [
                'id' => $post_id,
                'title' => $post->title,
                'body' => $post->body,
                'error_title' => '',
                'error_body' => '',
            ];
            $this->loadView('posts/edit', $data);
        }
    }

    public function show($post_id)
    {
        $post = $this->postModel->getPostById($post_id);
        $user = $this->userModel->getUserById($post->user_id);
        $data = [
            'post' => $post,
            'user' => $user
        ];

        $this->loadView('posts/show', $data);
    }

    public function delete($post_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            // get existing post from model
            $post = $this->postModel->getPostById($post_id);

            //check for owner
            if ($post->user_id != $_SESSION['user_id']) {
                redirect('posts');
            }
            
            if ($this->postModel->deletePost($post_id)) {
                flash('post_message', 'Post deleted successfully');
                redirect('posts');
            } else {
                die("Something went wrong");
            }
        } else {
            redirect('posts');
        }
    }
}
