<?php


class JsonResponse{
    static public function view($response,$status){
        echo json_encode($response,http_response_code($status));
    }
}