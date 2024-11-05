<?php

class AutoresModel {
    public function __construct() {
        $this->db = $this->createConection();
    }

    Private function createConection(){
        $host = 'localhost';
        $userName = 'root';
        $password = '';
        $database = 'biblioteca';
        $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $userName , $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public function getAll(){
        $sentencia=$this->db->prepare("SELECT * FROM autores");
        $sentencia->execute();
        $autores= $sentencia->fetchAll(PDO::FETCH_OBJ);
        
        return $autores;
    }

    public function getId(){
        $sentencia = $this->db->prepare("SELECT autores.nombre_autor, autores.id_autor FROM autores");
        $sentencia->execute();
        $autores= $sentencia->fetchAll(PDO::FETCH_OBJ);

        return $autores;
    }

    public function newAuthor($nombre_autor, $nacimiento_autor, $nacionalidad_autor){
        $sentencia= $this->db->prepare("INSERT INTO autores(nombre_autor, nacimiento_autor, nacionalidad_autor) VALUE(?,?,?)");
        $sentencia->execute([$nombre_autor, $nacimiento_autor, $nacionalidad_autor]);
    }

    public function getAuthor($id_autor){
        $sentencia= $this->db->prepare("SELECT autores.nombre_autor, autores.nacimiento_autor, autores.nacionalidad_autor autores.id_autor FROM autores WHERE id_autor=?");
        $sentencia->execute([$id_autor]);
        $autor= $sentencia->fetch(PDO::FETCH_OBJ);

        return $autor;
    }

    public function deleteAuthor($idautor){
        $sentencia = $this->db->prepare("DELETE FROM autores WHERE id_autor = ?");
        $sentencia->execute([$idautor]);
    }

    public function updateAuthor($id_autor, $nombre_autor, $nacimiento_autor, $nacionalidad_autor){
        $sentencia= $this->db->prepare("UPDATE autores SET nombre_autor=?, nacimiento_autor=?, nacionalidad_autor=? WHERE autores.id_autor=?");
        $sentencia->execute([$nombre_autor, $nacimiento_autor, $nacionalidad_autor, $id_autor]);
    }
}