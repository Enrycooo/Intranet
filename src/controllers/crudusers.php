<?php

namespace Application\Controllers\CrudUsers;

require_once('src/lib/database.php');
require_once('src/model/user.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\User\User_Model;

class CrudUsers
{
    public function execute(int $id_employe)
    {
        $id = $id_employe;
        
        $crudModel = new User_Model();
        $crudModel->connection = new DatabaseConnection();
        $cruds = $crudModel->getCrudUsers();
        
        if($_SESSION['id'] !== ""){
            require('templates/Users/index.php');
        }else{
            header("Location: index.php");
        }
    }
}
