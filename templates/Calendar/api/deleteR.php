<?php
include("../config.php");

if (isset($_POST["idR"])) {
    $db->deleteRById('cours',$_POST['idR']);
}
