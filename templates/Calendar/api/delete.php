<?php
include("../config.php");

if (isset($_POST["id"])) {
    $db->deleteById('cours',$_POST['id']);
}
