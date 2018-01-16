<?php
/**
 * Created by PhpStorm.
 * User: Marc
 * Date: 30-08-2017
 * Time: 09:05
 */

class DB extends \PDO
{
    //Fields
    /**
     * @var
     */
    private $host;
    /**
     * @var
     */
    private $user;
    /**
     * @var
     */
    private $pass;
    /**
     * @var PDO
     */
    private $conn;
    /**
     * @var
     */
    private $query;
    /**
     * @var bool
     */
    private $debug = false;

    //properties

    /**
     * @param bool $bool
     */
    public function debug($bool = true)
    {
        $this->debug = $bool;
    }

    /**
     * @param $sql
     */
    private function setQuery($sql)
    {
        $this->query = $this->prepare($sql);
    }

    /**
     * DB constructor.
     * @param $dbhost
     * @param $dbuser
     * @param $dbpass
     * @param array $options
     */
    public function __construct($dbhost, $dbuser, $dbpass, $options = [])
    {
        try {
            $this->conn = parent::__construct($dbhost, $dbuser, $dbpass, $options);
        } catch (\PDOException $e) {
            print "Fejl!: " . $e->getMessage() . "<br/>";
            die();
        }

    }

    /**
     * @param string $sql
     * @param bool $params
     * @param int|mixed|null $returnType
     * @return mixed
     */
    public function query($sql, $params = false, $returnType = \PDO::FETCH_OBJ)
    {
        $this->setQuery($sql);
        $this->execute($params);
        $this->count = $this->query->rowCount();

        return $this->query->fetchAll($returnType);
    }

    /**
     * @param $params
     */
    private function execute($params)
    {
        if($params){
            $this->query->execute($params);
        } else {
            $this->query->execute();
        }
        if($this->debug){
            echo '<pre id="debug_params">',$this->query->debugDumpParams(),'</pre>';
        }
    }

    /**
     * @param $sql
     * @param bool $params
     * @return mixed
     */
    public function single($sql, $params = false){
        $data = $this->query($sql, $params);
        if(sizeof($data) === 1){
            return $data[0];
        } else {
            return false;
        }
    }

    /**
     * @param $sql
     * @param bool $params
     * @return mixed
     */
    public function first($sql, $params = false){
        return $this->query($sql, $params)[0];
    }

    /**
     * @param $sql
     * @param bool $params
     * @return mixed
     */
    public function last($sql, $params = false){
        return $this->query($sql, $params)[$this->count - 1];
    }

    /**
     * @param $sql
     * @param bool $params
     * @return mixed
     */
    public function toList($sql, $params = false){
        return $this->query($sql, $params);
    }

    /**
     * @param $sql
     * @param bool $params
     * @return mixed
     */
    public function lastId($sql, $params = false){
        $this->query($sql, $params);
        return $this->query->lastInsertId();
    }
}