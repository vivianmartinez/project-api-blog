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
        return JsonResponse::errorView(404);
    }

    /**
     * GET single post
     * */

     public function one($id){
        $this->post->setId($id);
        $post = $this->post->findOne();

        if($post){
            return JsonResponse::view($post,200);
        }
        return JsonResponse::errorView(404);
    }

}