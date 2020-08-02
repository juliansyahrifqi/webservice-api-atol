<?php
class Database {

    private $host = "localhost";
    private $db = "uas_atol";
    private $username = "root";
    private $pass = "";

    public $koneksi;

    public function getKoneksi() {
        
        $this->koneksi = null;

        try {
            $this->koneksi = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db, $this->username, $this->pass);
            $this->koneksi->exec("set names utf8");
        } catch (PDOException $e) {
            echo "Koneksi Error : " . $e->getMessage();
        }

        return $this->koneksi;
    }   
}

?>