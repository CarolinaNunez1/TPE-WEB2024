<?php

class LibrosModel {
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

    public function getBooksAndAuthors(){
        $sentencia=$this->db->prepare("SELECT libros.nombre_libro AS NombreLibro, autores.nombre_autor AS Autor, libros.id_libro  FROM libros JOIN autores ON libros.id_autor=autores.id_autor ORDER BY libros.nombre_libro ASC");      
        $sentencia->execute();
        $libros= $sentencia->fetchAll(PDO::FETCH_OBJ);
        
        return $libros;
    }

    public function getBooksOfAuthor($idAutor){
        $sentencia = $this->db->prepare("SELECT libros.nombre_libro AS NombreLibro, autores.nombre_autor AS Autor, autores.id_autor AS IdAutor,
        libros.id_autor,  libros.id_libro  FROM libros JOIN autores ON libros.id_autor=autores.id_autor WHERE autores.id_autor= ? ORDER BY libros.nombre_libro ASC");
        $sentencia->execute([$idAutor]);
        $books = $sentencia->fetchAll(PDO::FETCH_OBJ);

        return $books;
    }

    public function getDetailOfBook($idlibro){
        $sentencia = $this->db->prepare("SELECT libros.nombre_libro AS NombreLibro, autores.nombre_autor AS Autor, 
        libros.tipo AS Tipo, libros.sinopsis AS Sinopsis, libros.anio AS Anio, libros.id_autor,
        libros.id_libro  FROM libros JOIN autores ON libros.id_autor=autores.id_autor 
        WHERE id_libro = ?");
        $sentencia->execute([$idlibro]);
        $details = $sentencia->fetch(PDO::FETCH_OBJ);

        return $details;
    }

    public function getAuthorBook(){
        $sentencia= $this->db->prepare("SELECT autores.id_autor, libros.nombre_libro FROM autores JOIN libros");
        $sentencia->execute();
        $libro= $sentencia->fetchAll(PDO::FETCH_OBJ);

        return $libro;
    }

    public function newBook($nombre_libro, $tipo, $sinopsis, $anio, $autor){
        $sentencia= $this->db->prepare("INSERT INTO libros(nombre_libro, tipo, sinopsis, anio, id_autor) VALUE(?, ?, ?, ?, ?)");
        $sentencia->execute([$nombre_libro, $tipo, $sinopsis, $anio, $autor]);
    }

    public function getBook($idlibro){
        $sentencia = $this->db->prepare("SELECT libros.nombre_libro, libros.tipo, libros.sinopsis, libros.anio,
        libros.id_libro, autores.nombre_autor AS autor, autores.id_autor FROM libros JOIN autores ON libros.id_autor=autores.id_autor WHERE id_libro = ?");
        $sentencia->execute([$idlibro]);
        $libro= $sentencia->fetch(PDO::FETCH_OBJ);

        return $libro;
    }

    public function deleteBook($idlibro){
        $sentencia = $this->db->prepare("DELETE FROM libros WHERE id_libro = ?");
        $sentencia->execute([$idlibro]);
    }

    public function updateBook($id_libro, $nombre_libro, $tipo, $sinopsis, $anio, $autor){
        $sentencia = $this->db->prepare("UPDATE libros SET nombre_libro=?, tipo=?, sinopsis=?, anio =?, id_autor=? 
        WHERE libros.id_libro=?");
        $sentencia->execute([$nombre_libro, $tipo, $sinopsis, $anio, $autor, $id_libro]);
    }
}