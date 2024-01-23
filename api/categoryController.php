<?php

require_once 'models/category.php';

class CategoryController{

    private $category;
    public $error400;
    public $error404;
    public $error500;

    public function __construct()
    {
        $this->category = new Category();
        $this->error400 = ['error' => true,'status' => 400,'message' => 'Bad request'];
        $this->error404 = ['error' => true,'status' => 404,'message' => 'Not Found'];
        $this->error500 = ['error' => true,'status' => 500,'message' => 'Something bad happend. Insternal Error'];
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
        return JsonResponse::view($this->error404,404);
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
        return JsonResponse::view($this->error404,404);
    }

    /**
     * POST new category
     * */
    public function create(){
        $request = file_get_contents('php://input');
        $data = json_decode($request,true);
        if($data == null || count($data) != 1 || !array_key_exists('nombre',$data)){
            return JsonResponse::view($this->error400,400);
        }

        $this->category->setNombre($data['nombre']);
        $category = $this->category->save();
        if($category){
            $new = $this->category->findOne();
            return JsonResponse::view($new,200);
        }
        return JsonResponse::view($this->error500,500);
    }
}