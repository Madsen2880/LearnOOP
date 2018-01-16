<?php
/**
 * Copyright (c) 2017
 * Author: Marc Carpens
 * Pers.ID: 4030638
 * School: Roskilde Technical School
 * License: Closed
 */

class User extends \PDO
{

    /**
     * @var
     */
    private $username;

    /**
     * @var
     */
    private $password;

    /**
     * @var null
     */
    private $db = null;

    /**
     * User constructor.
     * @param $db
     */
    public function __construct($db) {
        $this->db = $db;
    }

    # Only accept the $_POST inputs and not $_GET inputs.

    /**
     * Tjekker request method
     *
     * @param string $method
     * @return boolean
     */
    public function secCheckMethod($method) {
        return (filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_SPECIAL_CHARS) === strtoupper($method)) ? true : false;
    }

    #Sanitize the users input from forms

    /**
     * Returnér filtreret superglobal
     *
     * @param string $input
     * @return string
     */
    public function secGetInputArray($input) {
        return filter_input_array(strtoupper($input), FILTER_SANITIZE_SPECIAL_CHARS);
    }

    ## Login Method Filter Function

    /**
     * @param $method
     * @return bool
     */
    public function methodCheck($method) {
        $requestMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_SPECIAL_CHARS);
        if ($requestMethod === $method) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    ## Token Generator

    /**
     *
     */
    private function generateToken() {
        if ($this->isSessionStarted() == false) {
            session_start();
        }
        $_SESSION['token'] = sha1(time()*rand(5,1000));
        $_SESSION['tokentime'] = time();
    }

    ## Get token

    /**
     * @return mixed
     */
    public function getToken() {
        if ($this->isSessionStarted() == false) {
            session_start();
        }
        if(isset($_SESSION['token'])) {
            return $_SESSION['token'];
        } else {
            $this->generateToken();
            return $_SESSION['token'];
        }
    }

    ## Validate Token

    /**
     * @param $token
     * @return bool
     */
    public function validateToken($token) {
        if ($this->isSessionStarted() == false) {
            session_start();
        }
        if ($token === $_SESSION['token']) {
            if ((time() - $_SESSION['tokentime']) > 120) {
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return FALSE;
        }
    }

    ## Delete the token after use

    /**
     *
     */
    public function destroyToken(){
        if ($this->isSessionStarted() == false) {
            session_start();
        }
        if(isset($_SESSION['token']) && isset($_SESSION['tokentime'])) {
            unset($_SESSION['token']);
            unset($_SESSION['tokentime']);
        }
    }

    ## Is session started

    /**
     * @return bool
     */
    public function isSessionStarted() {
        if (php_sapi_name() !== 'cli') {
            if (version_compare(phpversion(), '5.4.0', '>=') ) {
                return session_status() === PHP_SESSION_ACTIVE ? true : false;
            } else {
                return session_id() === '' ? false : true;
            }
        }
        return true;
    }

    # Get all users data

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->db->toList("SELECT * FROM `users`");
    }


    # Get one users data

    /**
     * @param $id
     * @return mixed
     */
    public function getOne($id)
    {
        return $this->db->single("SELECT * FROM `users` WHERE id = :id",
            [
                ':id' => $id,
            ]
        );
    }

    /**
     * Find brugerens niveau fra db
     *
     * @return integer
     */
    public function secCheckLevel(){
        $stmt = $this->db->prepare("SELECT userrole.niveau FROM `users`
								INNER JOIN `userrole` ON `userrole`.`id` = `users`.`fk_userrole`
								WHERE `users`.`id` = :id");
        $stmt->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount() === 1){
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result->niveau;
        } else {
            return 0;
        }
    }

    /**
     * @param $username
     * @return mixed
     */
    public function checkUsername($username) {
        return $this->db->single("SELECT username FROM users WHERE username=:uname",
            [':uname' => $username]);
    }

    /**
     * @param $username
     * @param $firstname
     * @param $lastname
     * @param $password
     * @return mixed
     */
    public function register($firstname, $lastname, $username, $password)
    {
        try
        {
            $new_password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

            $this->db->query("INSERT INTO users (firstname, lastname, username, password, fk_userrole) 
                                VALUES (:fname, :lname, :uname, :upass, 3)",
                                [
                                    ':fname' => $firstname,
                                    ':lname' => $lastname,
                                    ':uname' => $username,
                                    ':upass' => $new_password
                                ]);


            return true;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }


    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function doLogin($username, $password)
    {
        try
        {
            $stmt = $this->db->single("SELECT id, username, password FROM users WHERE username = :uname", [':uname' => $username]);
            if($stmt == true)
            {
                if(password_verify($password, $stmt->password))
                {
                    $_SESSION['user_id'] = $stmt->id;
                    $_SESSION['username'] = $stmt->username;
                    return true;
                }
                else
                {
                    return false;
                }
            } else {
                return false;
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * @return bool
     */
    public function is_loggedin()
    {
        if(isset($_SESSION['user_id']))
        {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $url
     */
    public function redirect($url)
    {
        header("Location: index.php?side=".$url."");
    }

    /**
     * @return bool
     */
    public function doLogout()
    {
        session_destroy();
        unset($_SESSION['user_session']);
        header('Location: ./index.php?side=forside');
        return true;
    }

}