<?php

class AdminModel {
    public function __construct() {
        $this->db = $this->createConnection();
    }

    private function createConnection(){
        $host = 'localhost';
        $admin = 'root';
        $password = '';
        $database = 'biblioteca';
        $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $admin, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public function getAdmin($nombre) {
        $query = $this->db->prepare("SELECT * FROM administrador WHERE nombre = ?");
        $query->execute([$nombre]);
        $admin = $query->fetch(PDO::FETCH_OBJ);
        return $admin;
    }
}