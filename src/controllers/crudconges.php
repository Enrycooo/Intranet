<?php

namespace Application\Controllers\CrudConges;

require_once('src/lib/database.php');
require_once('src/model/Conges.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Conges\Conges_model;

class CrudConges
{
    public function execute(int $id_employe)
    {
        $id = $id_employe;
        
        $crudModel = new Conges_model();
        $crudModel->connection = new DatabaseConnection();
        $cruds = $crudModel->getCrud();
        
        if($_SESSION['id'] !== ""){
            require('templates/Conges/index.php');
        }else{
            header("Location: index.php");
        }
    }
}