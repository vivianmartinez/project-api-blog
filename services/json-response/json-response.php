<?php


class JsonResponse{

    public $error400;
    public $error404;
    public $error500;

    public function __construct()
    {
        $this->error400 = ['error' => true,'status' => 400,'message' => 'Bad request'];
        $this->error404 = ['error' => true,'status' => 404,'message' => 'Not Found'];
        $this->error500 = ['error' => true,'status' => 500,'message' => 'Something bad happend. Insternal Error'];
    }

    static public function view($response,$status){
        echo json_encode($response,http_response_code($status));
    }

    static public function errorView($status){
        $self = new self();
        switch($status){
            case 400:
                $self->view($self->error400,$status);
                break;
            case 404:
                $self->view($self->error404,$status);
                break;
            default:
                $self->view($self->error500,$status);
        }
    }

    static public function errorViewMsg($status,$message){
        $self = new self();
        switch($status){
            case 400:
                $self->view(['error' => true, 'status' => $status, 'message' => $message],$status);
                break;
            case 404:
                $self->view(['error' => true, 'status' => $status, 'message' => $message],$status);
                break;
            default:
                $self->view(['error' => true, 'status' => $status, 'message' => $message],$status);
        }
    }
}