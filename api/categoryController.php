<?php

require_once 'models/category.php';

class CategoryController{

    private $category;

    public function __construct()
    {
        $this->category = new Category();
    }
      /**
     * GET All categories
     * */

    public function categories()
    {
        $categories = $this->category->findAll();
        if($categories){
            return JsonResponse::view($categories,200);
        }
        return JsonResponse::errorView(404);
    }

    /**
     * GET single category
     * */

    public function one($id){
        $this->category->setId($id);
        $category = $this->category->findOne();

        if($category){
            return JsonResponse::view($category,200);
        }
        return JsonResponse::errorView(404);
    }

    /**
     * POST new category
     * */
    public function create(){
        $request = file_get_contents('php://input');
        $data = json_decode($request,true);
        if($data == null || count($data) != 1 || !array_key_exists('nombre',$data)){
            return JsonResponse::errorView(400);
        }

        $this->category->setName($data['nombre']);
        $category = $this->category->save();
        if($category){
            $new = $this->category->findOne();
            return JsonResponse::view($new,200);
        }
        return JsonResponse::errorView(500);
    }

     /**
     * DELETE category
     * */

    public function delete($id){
        $this->category->setId($id);
        $category = $this->category->findOne();
        if(!$category){
            return JsonResponse::errorView(404);
        }
        $delete = $this->category->delete();
        if($delete){
            $message = ['error' => false, 'status' => 200, 'message'=>'category deleted'];
            return JsonResponse::view($message,200);
        }
        return JsonResponse::errorView(500);
    }
     /**
     * UPDATE category
     * */
    public function update($id){
        $this->category->setId($id);
        $category = $this->category->findOne();
        $request = file_get_contents('php://input');
        $data = json_decode($request,true);
        //validate if exists category and validate json
        if(!$category || $data == null || count($data) > 1 || !array_key_exists('nombre',$data)){
            return JsonResponse::errorView(404);
        }
        $this->category->setName($data['nombre']);
        $update = $this->category->update($id);
        if(!$update){
            return JsonResponse::errorView(500);
        }
        
        return JsonResponse::view($this->category->findOne(),200);
    }
}