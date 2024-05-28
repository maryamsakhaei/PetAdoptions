<?php
require_once "../utils/crudPet.php";
require_once "../utils/formUtils.php";

session_start();
preventUser();

$id = $_GET["id"];

$crud = new CRUD_PET();

$getAnimal = $crud->selectPets("id = $id");

removeOldPetImage($getAnimal[0]["image"]);

$delete = $crud->deletePet($id);

if ($delete) {
    if (isset($_SESSION["Adm"])) {
        header("Location: ../admin/dashboard.php");
    } else {
        header("Location: ../agency/dashboard.php");
    }
}
