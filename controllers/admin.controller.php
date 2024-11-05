<?php

require_once 'models/libros.model.php';
require_once 'models/autores.model.php';
require_once 'models/admin.model.php';
require_once 'views/admin.view.php';
require_once 'views/public.view.php';
require_once 'helpers/autentication.helper.php';

class AdminController{

    private $modelLibro;
    private $modelAutor;
    private $modelAdmin;
    private $viewAdmin;
    private $viewPublic;
    private $helpers;


    public function __construct() {
        $this->modelLibro = new LibrosModel();
        $this->modelAutor = new AutoresModel();
        $this->modelAdmin = new AdminModel();
        $this->viewAdmin = new AdminView();
        $this->viewPublic = new PublicView();
        $this->helpers = new HelperAutenticacion();
    }

    public function showError($error) {
        $this->viewAdmin->showError($error); 
    }

    public function verifyAdmin() {
        $nombre = $_POST['nombre'];
        $password = $_POST['password'];

        $admin = $this->modelAdmin->getAdmin($nombre);


        if ($admin && password_verify($password, $admin->password)) { 

            session_start();
            $_SESSION['logged'] = true;
            $_SESSION['id_admin'] = $admin->id_admin;
            $_SESSION['adminmail'] = $admin->mail;
            $_SESSION['adminname'] = $admin->nombre;
            $_SESSION['admin']= $admin->admin;
            
            header("Location: " . BASE_URL . 'admin');
        }

        if (!$admin){
            $this->viewPublic->showFormLoginAdmin("El mail ingresado no está registado");
        } else{
            $this->viewPublic->showFormLoginAdmin("Contraseña incorrecta");
        }
    }

    public function showOptionAdmin(){
        $this->viewAdmin->showOptionAdmin();
    }

    //agregar libro nuevo
    public function addBook(){
        //Tomo datos del formulario
        $nombre_libro= $_POST['nombreLibro'];
        $tipo= $_POST['tipo'];
        $sinopsis= $_POST['sinopsis'];
        $anio= $_POST['anio'];
        $autor= $_POST['autor'];


        //verifico que no se repita dos veces el mismo libro
        $autores= $this->modelAutor->getId();
        $libro= $this->modelLibro->getAuthorBook();
        foreach($libro as $libros){
            if (($nombre_libro == $libros->nombre_libro) && ($autor == $libros->id_autor)){
                $this->viewAdmin->formAddBook($autores, "El libro ingresado ya existe");
                die();
            }
        }

        //verifico que todos los campos estén completados para enviar los datos al formulario
        if (!empty($nombre_libro) && !empty($tipo) && !empty($sinopsis) && !empty($anio) && !empty($autor)){
            $this->modelLibro->newBook($nombre_libro, $tipo, $sinopsis, $anio, $autor);
            $this->viewAdmin->formAddBook($autores, "El libro '$nombre_libro' se agrego con éxito");
        }else {
            $this->viewAdmin->formAddBook($autores, "Faltan completar campos");
            die();
        }
    }

    public function showFormForAggBook(){
        //traigo del modelo los id de los autores
        $id= $this->modelAutor->getId();
        //mando el id al viewAdmin para crear el formulario
        $this->viewAdmin->formAddBook($id);
    }

    //manda al formulario para modificar el libro
    public function modifyBook($idlibro){
        //traigo el libro para modificar al modelo
        $autores= $this->modelAutor->getId();
        $libro = $this->modelLibro->getBook($idlibro);

        $this->viewAdmin->formEditBook($libro, $autores);
    }

    //elimina libro
    public function deleteBook($idlibro){
        $this->modelLibro->deleteBook($idlibro);
        $libros = $this->modelLibro->getBooksAndAuthors();

        $this->viewAdmin->showEditBooks($libros, "El libro ha sido eliminado con éxito");
    }

    //muestra la tabla para editar-eliminar
    public function editBooks(){
        //traigo los libros del modelo
        $libros= $this->modelLibro->getBooksAndAuthors();

        $this->viewAdmin->showEditBooks($libros);
    }

    //editar libro
    public function saveChangesBook($id_libro){
        $nombre_libro= $_POST['nombreLibro'];
        $tipo= $_POST['tipo'];
        $sinopsis= $_POST['sinopsis'];
        $anio= $_POST['anio'];
        $autor= $_POST['autor'];

        $libros = $this->modelLibro->getBooksAndAuthors();

        if(!empty($nombre_libro) && !empty($tipo) && !empty($sinopsis) && !empty($anio) && !empty($autor)){
            $this->modelLibro->updateBook($id_libro, $nombre_libro, $tipo, $sinopsis, $anio, $autor);
            header("Location: " . BASE_URL . 'editLibros');
        }
        else{
            $this->viewAdmin->showError("Faltan completar campos");
            die();
        }
    }
}