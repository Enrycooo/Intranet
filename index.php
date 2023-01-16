<?php

session_start();

if($_SESSION == null){
    $_SESSION['username']="";
    $_SESSION['password']="";
    $_SESSION['id']="";
}

if($_SESSION['username'] !== "" && $_SESSION['password'] !== ""){
    header("Location: index.php?action=connected&id=$id");
}

require_once('src/controllers/Login.php');
require_once('src/controllers/homepage.php');
require_once('src/controllers/mainpage.php');
require_once('src/controllers/navbar.php');
require_once('src/controllers/createuser.php');
require_once('src/controllers/createconges.php');
require_once('src/controllers/crudconges.php');

use Application\Controllers\Login\Login;
use Application\Controllers\Homepage\Homepage;
use Application\Controllers\Mainpage\Mainpage;
use Application\Controllers\Navbar\Navbar;
use Application\Controllers\CreateUser\CreateUser;
use Application\Controllers\CreateConges\CreateConges;
use Application\Controllers\CrudConges\CrudConges;


try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'connection') { 
            (new Login())->execute($_POST);
        }elseif($_GET['action'] === 'connected'){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id_employe = $_GET['id'];
                
            (new Navbar())->execute();
                (new Mainpage())->execute();
            } else {
                throw new Exception('Erreur de connexion au site');
            }
        }elseif($_GET['action'] === 'createUser' && $_SESSION['id_poste'] == 1){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id_employe = $_GET['id'];
                
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }
            (new Navbar())->execute();
            (new CreateUser())->execute($input, $id_employe);
            } else {
                throw new Exception('Erreur de connexion au site');
            }
        }elseif($_GET['action'] === 'createConges'){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id_employe = $_GET['id'];
                
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }
            (new Navbar())->execute();
            (new CreateConges())->execute($input, $id_employe);
            } else {
                throw new Exception('Erreur de connexion');
            }
        }elseif($_GET['action'] === 'crudconges' && $_SESSION['id_poste'] == 1){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id_employe = $_GET['id'];
                
                (new Navbar())->execute();
                (new CrudConges())->execute($id_employe);
            } else {
                throw new Exception('Erreur de connexion');
            }
        }elseif($_GET['action'] === 'deconnection'){
            (new Mainpage())->logout();
        }else {
            throw new Exception("La page que vous recherchez n'existe pas.");
        }
    } else {
        if($_SESSION['id'] !== ""){
            $id = $_SESSION['id'];
            header("Location: index.php?action=connected&id=$id");
        }elseif($_SESSION['id'] == ""){
            header('Location= index.php');
        (new Homepage())->execute();
        }
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();

    require('templates/error.php');
}