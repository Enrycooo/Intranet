<?php

namespace Application\Controllers\Mainpage;

class Mainpage
{
    public function logout()
	{
                session_destroy();
		header('location: index.php');
		exit;
	}
    
    public function execute()
    {
        if($_SESSION['username'] !== ""){
            require('templates/mainpage.php');
        }else{
            header("Location: index.php");
        }
    }
}
