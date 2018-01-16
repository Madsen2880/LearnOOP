<?php
/**
 * Created by PhpStorm.
 * User: Marc
 * Date: 26-09-2017
 * Time: 08:42
 */

class Settings {

    private $db = null;

    /**
     * Settings constructor.
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllMenu()
    {
        return $this->db->toList("SELECT * FROM `menu`");
    }

//    Kommenteret ud, da vi ikke skal bruge denne metode lige nu!

    public function getAllSettings()
    {
        return $this->db->toList("SELECT * FROM `settings`");
    }
}
