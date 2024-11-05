<?php

class HelperAutenticacion {

    static public function checkLoggedAdmin() {
        if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
        }

        if (!isset($_SESSION['logged']) || ($_SESSION['admin']!=1)) {
            header('Location: ' . BASE_URL . 'admin');
            die();
        }
    }

    static public function getAdminName(){
        
        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }

        $adminName = $_SESSION['adminName'];

        return $adminName;
    }

    static public function getIdAdmin() {
        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }

        if (isset($_SESSION['logged'])){
        return $_SESSION['id_admin'];
        }
    }
}