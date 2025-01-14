<?php
namespace Model;
use JsonSerializable;
class User implements JsonSerializable{
    private $username;

    
    public function __construct($username = null) {    
        $this->username = $username;
    }
    public function getUsername(){
        return $this->username;
    }
    public function jsonSerialize(){
        return get_object_vars($this);
    }

    public static function fromJson($data){
        $user = new User();
        foreach($data as $key => $value){
            $user->$key = $value;
    }
    return $user;
}
}