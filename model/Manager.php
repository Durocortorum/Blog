<?php
namespace Mde\Blog\Model;

class Manager
{
    protected function dbConnect()
    {

        $db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8;port=3308', 'root', '');
        return $db;
    }
}