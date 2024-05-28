<?php
require_once "../utils/crudUser.php";
require_once "../utils/formUtils.php";

session_start();
preventUser();
preventAgency();

$id = $_GET["id"];

$crud = new CRUD_USER();

$getUser = $crud->selectUsers("id = $id");

removeOldUserImage($getUser[0]["image"]);

$crud->deleteUser($id);
