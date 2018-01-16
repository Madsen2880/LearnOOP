<?php
/**
 * Created by PhpStorm.
 * User: mcarp
 * Date: 12-01-2018
 * Time: 10:59
 */

class Email extends \PDO{

    private $db = null;

    /**
     * User constructor.
     * @param $db
     */
    public function __construct($db) {
        $this->db = $db;
    }

    public function validateContact($postInfo) {
        $error = [];
        foreach($postInfo as $key => $value) {
            if($value == "" && $key !== 'btn_send') {
                $keyValue = ucfirst($key);
                $error[$key] = '<br>
                            <div class="alert alert-danger alert-dismissible" id="myAlert">
                            <a href="#" class="close">&times;</a>
                            <i class="glyphicon glyphicon-warning-sign"></i>
                            Udfyld venligst '.$keyValue.'
                            </div>';
            }
        }
        return $error;
    }

    public function sendMail($postInfo)
    {
        try
        {

            $this->db->query("INSERT INTO messages (name, email, message) 
                                VALUES (:name, :email, :message)",
                [
                    ':name' => $postInfo['navn'],
                    ':email' => $postInfo['email'],
                    ':message' => $postInfo['besked']
                ]);


            return true;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    public function getAllEmails() {
        return $this->db->toList('SELECT * FROM `messages`');
    }
    
    public function deleteEmail($id)
    {
        return $this->db->query("DELETE FROM messages WHERE id = :id", [':id' => $id]);
    }

}