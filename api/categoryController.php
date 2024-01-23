<?php

require_once 'models/category.php';

class CategoryController{

    private $category;
    public $error400;
    public $error404;

    public function __construct()
    {
        $this->category = new Category();
        $this->error400 = ['error' => true,'status' => 400,'message' => 'Bad request'];
        $this->error404 = ['error' => true,'status' => 404,'message' => 'Not Found'];
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
        return JsonResponse::view('No data',404);
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

    }
}