<?php

require_once 'models/libros.model.php';
require_once 'models/admin.model.php';
require_once 'views/public.view.php';


class PublicController{

    private $modelLibro;
    private $modelAdmin;
    private $view;

    public function __construct() {
        $this->modelLibro = new LibrosModel();
        $this->modelAdmin = new AdminModel();
        $this->view = new PublicView();
    }

    public function showFormLoginAdmin() {
        $this->view->showFormLoginAdmin();
    }

    public function showError($error) {
        $this->view->showError($error); 
    }

    public function showHome(){
        $libros = $this->modelLibro->getBooksAndAuthors();

        //actualizo la vista
        $this->view->showListBooks($libros);
    }

    public function showAllBooks(){
        //traigo los libros del modelo
        $libros = $this->modelLibro->getBooksAndAuthors();

        $this->view->showListBooks($libros);
    }

    public function showBooksAuthor($idAutor){
        //traigo los libros del autor del modelo
        $books = $this->modelLibro->getBooksOfAuthor($idAutor);

        if (!empty($books)){
            $this->view->showListBooksOfAuthor($books); //actualizo la vista
        }
        else {
            $this->view->showError("No hay libros del autor para mostrar");
        }
    }

    public function infoBooks($idlibro){

        if(!empty($idlibro)){
            //traigo los libros del modelo
            $details = $this->modelLibro->getDetailOfBook($idlibro);

            //actualizo la vista
            $this->view->showInfoOfBook($details);
        }else {
            $this->view->showError("No hay detalle del libro para mostrar");
        }
    }

}