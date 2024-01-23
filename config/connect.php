<?php

require_once 'database-info.php';

class Connection extends DBInfo{
    
    public function __construct()
    {
        parent::__construct();
    }

    static public function connect(){
        $self = new self();
    
        try{
            $link = new mysqli($self->host,$self->db_user,$self->db_pwd,$self->db_name);
            /*
            print_r($link);
            mysqli Object ( [affected_rows] => 0 [client_info] => mysqlnd 8.1.12 [client_version] => 80112 [connect_errno] => 0 [connect_error] => [errno] => 0 [error] => [error_list] => Array ( ) [field_count] => 0 [host_info] => localhost via TCP/IP [info] => [insert_id] => 0 [server_info] => 10.4.27-MariaDB [server_version] => 100427 [sqlstate] => 00000 [protocol_version] => 10 [thread_id] => 10 [warning_count] => 0 )
            */
            return $link;
        }catch(Exception $e){
            die("Connection error ". $e->getMessage());
        }
    }
}