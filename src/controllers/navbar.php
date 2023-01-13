<?php

namespace Application\Controllers\Navbar;

 if($_SESSION['username'] !== "" && $_SESSION['password'] !== ""){
    $user = $_SESSION['username'];
    $password = $_SESSION['password'];
 }else{
     header("index.php");
 }

class Navbar
{
    public function execute()
    {
        require('templates/navbar.php');
    }
}
