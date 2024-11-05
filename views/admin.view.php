<?php
    require_once('libs/smarty/Smarty.class.php');

class AdminView{

    private $smarty;

    public function __construct(){
        $this->smarty = new Smarty();
        $this->smarty->assign('base_url', BASE_URL);
        $this->smarty->assign('titulo', "Libros");
    }

    public function showError($msg) {
        $this->smarty->assign('msg', $msg);
        $this->smarty->display('showError.tpl');
    }
    
    public function showOptionAdmin(){
        $this->smarty->display('admin.tpl');
    }

    public function formAddBook($id, $error = null){
        $this->smarty->assign('id', $id);
        $this->smarty->assign('error', "$error");
        $this->smarty->display('showFormAddBook.tpl');
    }

    public function showEditBooks($libros, $error = null){
        $this->smarty->assign('info', $libros);
        $this->smarty->assign('error', "$error");
        $this->smarty->display('editBooks.tpl');

    }
    
    public function formEditBook($libro, $autores, $error = null){
        $this->smarty->assign('info', $libro);
        $this->smarty->assign('autor', $autores);
        $this->smarty->assign('error', "$error");
        $this->smarty->display('formEditBook.tpl');
    }
}