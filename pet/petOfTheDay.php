<?php
require_once "../utils/crudPet.php";
require_once "../utils/formUtils.php";

session_start();
preventUser();

$id = $_GET["id"];

$crud = new CRUD_PET();

$result = $crud->makePetOfDay($id);

if ($result) {
    header("Location: ../admin/dashboard.php");
}
