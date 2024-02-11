<?php

require_once 'models/post.php';

class PostController{

    private $post;
    private $user;
    private $category;

    public function __construct()
    {
        $this->post = new Post();
        $this->user = new User();
        $this->category = new Category();
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
    /**
     * POST new post
     * */
    public function create(){
        $request = json_decode(file_get_contents('php://input'),true) ?? null;
        if ($request == null){
            return JsonResponse::errorView(400);
        }
        if(array_key_exists('title',$request) && array_key_exists('category_id',$request) && array_key_exists('user_id',$request) ){
            $this->post->setTitle($request['title']);
            if($request['description']){
                $this->post->setDescription($request['description']);
            }
            $this->category->setId($request['category_id']);
            $category = $this->category->findOne();
            if(!$category){
                return JsonResponse::errorViewMsg(404,'Category not found');
            }
            $this->user->setId($request['user_id']);
            $user = $this->user->findOne();
            if(!$user){
                return JsonResponse::errorViewMsg(404,'User not found');
            }
            $this->post->setCategoryId($category['id']);
            $this->post->setUserId($user['id']);
            
            $new_post = $this->post->save();
            if($new_post){
                return JsonResponse::view($this->post->findOne(),200);
            }
            return JsonResponse::errorView(500);
        }else{
            return JsonResponse::errorView(400);
        }
    }

     /**
     * DELETE post
     * */
    public function delete($id){
        $this->post->setId($id);
        $post = $this->post->findOne();
        if(!$post){
            return JsonResponse::errorView(404);
        }
        $delete = $this->post->delete();
        if($delete){
            $message = ['error' => false, 'status' => 200, 'message'=>'post deleted'];
            return JsonResponse::view($message,200);
        }
        return JsonResponse::errorView(500);
    }   

    /**
     * UPDATE post 
     */
    public function update($id){
        $this->post->setId($id);
        $post = $this->post->findOne();
        if($post){
            $request = file_get_contents("php://input");
            $data = json_decode($request,true);
            if($data){
                if($data['title'] && is_string($data['title'])){
                    $this->post->setTitle($data['title']);
                }
                if($data['description'] && is_string($data['description'])){
                    $this->post->setDescription($data['description']);
                }
                if($data['category_id']){
                    $this->category->setId($data['category_id']);
                    $post_category = $this->category->findOne();
                    if(!$post_category){
                        return JsonResponse::errorViewMsg(404,'Category not found');
                    }
                    $this->post->setCategoryId($post_category['id']);
                }
                //verify this step
                if($data['user_id']){
                    $this->user->setId($data['user_id']);
                    $post_user = $this->user->findOne();
                    if(!$post_user){
                        return JsonResponse::errorViewMsg(404,'User not found');
                    }
                    $this->post->setUserId($post_user['id']);
                }
                //update post
            }else{
                return JsonResponse::errorView(400);
            }
        }else{
            return JsonResponse::errorView(404);
        }
    }
}