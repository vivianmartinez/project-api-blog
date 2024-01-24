<?php

require_once 'models/post.php';

class PostController{

    private $post;

    public function __construct()
    {
        $this->post = new Post();
    }

    /**
     * GET All posts
     * */
    public function posts()
    {
        $posts = $this->post->findAll();
        if($posts){
            return JsonResponse::view($posts,200);
        }
    }
}