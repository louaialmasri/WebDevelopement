<?php

namespace Model;

use JsonSerializable;

class Friend implements JsonSerializable
{
    private $username;
    private $status;

    public function getUsername()
    {
        return $this->username;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function __construct($username = null)
    {
        $this->username = $username;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function setAccepted()
    {
        $this->status = "accepted";
    }

    public function setDismissed()
    {
        $this->status = "dismissed";
    }

    public static function fromJson($data)
    {
        $user = new Friend();
        foreach ($data as $key => $value) {
            if($key == "username" || $key == "status") {
            $user->$key = $value;
        }
    }
        return $user;
    }
}
