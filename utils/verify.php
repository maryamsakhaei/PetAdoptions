<?php

require_once "../utils/crudUser.php";

$email = $_GET["email"];

$crud = new CRUD_USER();

$result = $crud->selectUsers("email = '$email'");

if (!empty($result)) {
    echo "Provided Email is already in use";
}
