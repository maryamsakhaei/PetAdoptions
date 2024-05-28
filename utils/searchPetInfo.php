<?php
session_start();
require_once "crudPet.php";
require_once "../pet/viewAll.php";

$value = $_GET["search"];

$crud = new CRUD_PET();

$result = $crud->selectPets("breed LIKE '$value%'");

echo viewPets($result);
