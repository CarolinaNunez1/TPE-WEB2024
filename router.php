<?php
    require_once 'controllers/public.controller.php';
    require_once 'controllers/admin.controller.php';

    define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

    // define una acción por defecto
    if (empty($_GET['action'])) {
        $_GET['action'] = 'home';
    } 

    // toma la acción del usuario y parsea los parámetros
    $accion = $_GET['action']; 
    $parametros = explode('/', $accion);

    // tabla de ruteo
    switch ($parametros[0]) {
        case 'home':
            $controller = new PublicController();
            $controller->showHome();
        break;
        case 'librosAutor':
            $controller = new PublicController();
            $controller->showBooksAuthor($parametros[1]);
        break;
        case 'mostrarLibros':
            $controller = new PublicController();
            $controller->showAllBooks();
        break; 
        case 'infoLibros':
            $controller = new PublicController();
            $controller->infoBooks($parametros[1]);
        break;
        case 'formLoginAdmin':
            $controller = new PublicController();
            $controller->showFormLoginAdmin();
        break;
        case "verifyAdmin": 
            $controller = new AdminController();
            $controller->verifyAdmin();
        break;
        case 'admin':
            $controller = new AdminController();
            $controller->showOptionAdmin();
        break;
        case 'nuevoLibro':
            $controller = new AdminController();
            $controller->showFormForAggBook();
        break;
        case 'editLibros':
            $controller = new AdminController();
            $controller->editBooks();
        break;
        case 'agregarLibro':
            $controller = new AdminController();
            $controller->addBook();
        break;
        case 'borrarLib':
            $controller = new AdminController();
            $controller->deleteBook($parametros[1]);
        break;
        case 'modificarLibro':
            $controller = new AdminController();
            $controller->modifyBook($parametros[1]);
        break;
        case 'guardarCambiosLib':
            $controller = new AdminController();
            $controller->saveChangesBook($parametros[1]);
        break;
        default:  
            $controller = new PublicController();
            $controller->showError("Lo siento! Esta página no está disponible</i>");
        break;

    }